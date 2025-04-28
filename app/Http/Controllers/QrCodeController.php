<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function testQrCode()
    {
        // URL для тестування
        $url = 'https://welcomeukraine.today/';

        // Генерація QR-коду для цього URL
        $qrCode = QrCode::size(250)->format('png')->generate($url); // Генеруємо QR-код в PNG форматі

        // Визначаємо шлях для збереження QR-коду
        $qrCodePath = storage_path('app/public/qrcodes/test_qr.png');

        // Зберігаємо QR-код як PNG
        file_put_contents($qrCodePath, $qrCode);

        // Перевіряємо, чи файл збережений
        if (file_exists($qrCodePath)) {
            return response()->json([
                'message' => 'QR-код успішно згенеровано!',
                'qr_code_path' => asset('storage/qrcodes/test_qr.png'), // Шлях до збереженого QR-коду
            ]);
        } else {
            return response()->json(['error' => 'Не вдалося зберегти QR-код.'], 500);
        }
    }
}
