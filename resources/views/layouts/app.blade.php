<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мій сайт</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<!-- Бокова панель -->
<div id="sidebar" class="sidebar">
    <button id="toggle-sidebar" class="toggle-btn">☰</button>
    <ul>
        <li><a href="{{ route('dashboard') }}">Дашборд</a></li>
        <li><a href="{{ route('acts.index') }}">Переглянути акти</a></li>
        <li><a href="{{ route('acts.create') }}">Створити акт</a></li>
        <li><a href="{{ route('acts.import') }}">Імпортувати акти</a></li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Вийти</button>
        </form>
    </ul>
</div>

<!-- Головний контент -->
<div class="main-content">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
