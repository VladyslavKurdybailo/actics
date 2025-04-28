<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Act;

class DashboardController extends Controller
{
    public function index()
    {
        // Отримуємо статистику
        $totalActs = Act::count(); // Загальна кількість актів
        $signedActs = Act::whereNotNull('signed_pdf_path')->count(); // Кількість підписаних актів
        $unsignedActs = $totalActs - $signedActs; // Кількість непідписаних актів

        // Повертаємо статистику на дашборд
        return view('dashboard', compact('totalActs', 'signedActs', 'unsignedActs'));
    }
}
