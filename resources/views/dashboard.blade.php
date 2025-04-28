<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <h1>Статистика по актам</h1>

        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Загальна кількість актів</h3>
                <p>{{ $totalActs }}</p>
            </div>
            <div class="stat-card">
                <h3>Підписано</h3>
                <p>{{ $signedActs }}</p>
            </div>
            <div class="stat-card">
                <h3>Не підписано</h3>
                <p>{{ $unsignedActs }}</p>
            </div>
        </div>
    </div>
@endsection
