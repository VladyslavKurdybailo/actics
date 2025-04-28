<?php

namespace App\Jobs;

use Google_Client;
use Google_Service_Sheets;
use App\Models\Act;
use PhpOffice\PhpWord\TemplateProcessor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportActsFromGoogleSheets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        // Підключаємо Google API
        $client = new Google_Client();
        $client->setAuthConfig(storage_path(env('GOOGLE_CREDENTIALS_PATH')));
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS_READONLY]);

        $service = new Google_Service_Sheets($client);
        $spreadsheetId = env('GOOGLE_SPREADSHEET_ID');
        $range = 'A1:AV';

        // Отримуємо дані
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            return;
        }

        // Вважаємо, що перший рядок — це заголовки
        $headers = array_shift($values);
        $createdActsCount = 0;

        foreach ($values as $row) {
            if (count($row) < count($headers)) {
                continue;
            }

            // Формуємо асоціативний масив
            $actData = array_combine($headers, $row);

            // Обробка дат (перетворення у формат YYYY-MM-DD)
            $datesToFix = ['date', 'last_check_date', 'ban_date', 'air_exchange_tool_last_check'];

            foreach ($datesToFix as $dateField) {
                if (!empty($actData[$dateField])) {
                    try {
                        $actData[$dateField] = Carbon::createFromFormat('d.m.Y', $actData[$dateField])->format('Y-m-d');
                    } catch (\Exception $e) {
                        $actData[$dateField] = null;
                    }
                } else {
                    $actData[$dateField] = null;
                }
            }

            // Створюємо новий акт у базі
            $act = Act::create($actData);

            // Генеруємо документи
            $this->generateWordAndPdf($act);

            $createdActsCount++;
        }
    }

    private function generateWordAndPdf($act)
    {
        // Визначаємо, який шаблон використовувати
        $templateFile = $act->conclusion === 'придатні' ? 'act_template.docx' : 'act_template1.docx';
        $templatePath = storage_path("app/public/{$templateFile}");
        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($act->toArray() as $key => $value) {
            $templateProcessor->setValue($key, $value ?? '');
        }

        // Генеруємо QR-код
        $qrCode = QrCode::size(125)->format('png')->generate(url('/acts/' . $act->id));
        $qrCodePath = storage_path('app/public/qrcodes/' . $act->id . '.png');
        file_put_contents($qrCodePath, $qrCode);
        $templateProcessor->setImageValue('qr_code', $qrCodePath);

        // Збереження документа Word
        $wordPath = storage_path('app/public/acts/' . $act->id . '_act.docx');
        $templateProcessor->saveAs($wordPath);


        $act->update([
            'pdf_path' => $wordPath,
            'word_path' => $wordPath,
            'qr_code' => $qrCodePath
        ]);
    }
}
