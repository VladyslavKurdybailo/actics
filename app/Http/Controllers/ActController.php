<?php

// app/Http/Controllers/ActController.php


namespace App\Http\Controllers;

use App\Models\Act;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;

class ActController extends Controller
{
    // Метод для відображення форми створення акту
    public function createForm()
    {
        return view('acts.create');
    }

    // Метод для створення акту
    public function createAct(Request $request)
    {
        // Валідність введених даних
        $validated = $request->validate([
            'act_number' => 'required|string',
            'check_type' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'executor' => 'required|string',
            'object_type' => 'required|string',
            'object_address' => 'required|string',
            'channels_count' => 'required|string',
            'equipment' => 'required|string',
            'customer_type' => 'required|string',
            'customer_name' => 'required|string',
            'dk_material' => 'nullable|string',
            'dk_material_2' => 'nullable|string',
            'dk1_area' => 'nullable|string',
            'dk2_area' => 'nullable|string',
            'vk1_area' => 'nullable|string',
            'vk2_area' => 'nullable|string',
            'pipe_material' => 'nullable|string',
            'pipe_area' => 'nullable|string',
            'pipe_length' => 'nullable|string',
            'pipe_turns' => 'nullable|string',
            'partition_condition' => 'nullable|string',
            'channel_condition' => 'nullable|string',
            'channel_separation' => 'nullable|string',
            'chimney_head' => 'nullable|string',
            'chimney_position_roof' => 'nullable|string',
            'chimney_position_wind' => 'nullable|string',
            'chimney_cracks' => 'nullable|string',
            'ventilation_cracks' => 'nullable|string',
            'cleaning_lid' => 'nullable|string',
            'draft_dk1' => 'nullable|string',
            'draft_dk2' => 'nullable|string',
            'draft_vk1' => 'nullable|string',
            'draft_vk2' => 'nullable|string',
            'measuring_tool' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'last_check_date' => 'nullable|date',
            'air_exchange' => 'nullable|string',
            'air_exchange_verified' => 'nullable|string',
            'air_exchange_tool_serial' => 'nullable|string',
            'air_exchange_tool_last_check' => 'nullable|date',
            'conclusion' => 'required|string',
            'reason_unfit' => 'nullable|string',
            'customer_type_accusative' => 'nullable|string',
            'owner_informed' => 'nullable|string',
            'ban_date' => 'nullable|date',
            'executor_rep' => 'required|string',
            'customer_rep' => 'required|string',
        ]);

        // Створюємо новий акт
        $act = Act::create($validated);

        // Шлях до шаблону Word
        $templateFile = $act->conclusion === 'придатні' ? 'act_template.docx' : 'act_template1.docx';
        $templatePath = storage_path("app/public/{$templateFile}");
        $templateProcessor = new TemplateProcessor($templatePath);

        // Заміняємо змінні в шаблоні
        foreach ($validated as $key => $value) {
            $templateProcessor->setValue($key, $value ?? ''); // Якщо значення null, то вставляємо пустий рядок
        }

        // Генерація QR-коду
        $qrCode = QrCode::size(125)->format('png')->generate(url('/acts/' . $act->id)); // Генеруємо QR-код у PNG форматі
        $qrCodePath = storage_path('app/public/qrcodes/' . $act->id . '.png'); // Шлях до збереження QR-коду
        file_put_contents($qrCodePath, $qrCode); // Зберігаємо QR-код

        // Вставка QR-коду в шаблон Word
        $templateProcessor->setImageValue('qr_code', $qrCodePath);

        // Шлях для збереження документа Word
        $outputPath = storage_path('app/public/acts/' . $act->id . '_act.docx');
        $templateProcessor->saveAs($outputPath);


        // Збереження шляху до PDF
        $act->pdf_path = $outputPath;
        $act->save();


        // Збереження шляху до QR-коду в базі
        $act->qr_code = $qrCodePath;
        $act->save();

        // Перенаправляємо на перегляд акту
        return redirect()->route('acts.show', $act->id);
    }


    // Метод для перегляду акту
    public function show($id)
    {
        $act = Act::findOrFail($id);

        return view('acts.show', compact('act'));
    }

    // Метод для завантаження підписаного акту
    public function uploadSignedAct(Request $request, $id)
    {
        // Валідність файлу
        $request->validate([
            'signed_pdf' => 'required|file|mimes:pdf|max:10240', // Перевірка на формат PDF
        ]);

        // Знайдемо акт за його ID
        $act = Act::findOrFail($id);

        // Завантажуємо підписаний PDF
        $path = $request->file('signed_pdf')->storeAs('signed_acts', 'signed_act_' . $act->id . '.pdf', 'public');
        $act->signed_pdf_path = $path;  // Зберігаємо шлях до підписаного акту в базі даних
        $act->save();

        return response()->json([
            'message' => 'Акт підписано та збережено!',
            'signed_pdf_path' => asset('storage/signed_acts/' . basename($act->signed_pdf_path)),
            'qr_code' => asset('storage/qrcodes/' . basename($act->qr_code))
        ]);
    }
    // Метод для перегляду списку актів
    public function index()
    {
        // Отримуємо всі акти з бази даних
        $acts = Act::all();

        // Повертаємо сторінку зі списком актів
        return view('acts.index', compact('acts'));
    }

}

