<?php

namespace App\Http\Controllers;

use App\Jobs\ImportActsFromGoogleSheets;


class GoogleSheetsController extends Controller
{
    // Метод для отримання даних з Google Таблиці та створення актів
    public function generateActsFromGoogleSheets()
    {
        // Відправляємо завдання у чергу
        dispatch(new ImportActsFromGoogleSheets());

        // Повертаємося на сторінку імпорту з повідомленням
        return redirect()->route('acts.import')->with('message', 'Імпорт запущено у фоновому режмі, це може зайняти від декількох секунд до декількох хвилин.');
    }


    public function showImportPage()
    {
        return view('acts.import');
    }
}
