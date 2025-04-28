@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Імпорт актів з Google Таблиці</h1>

        <!-- Повідомлення про імпорт -->
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Форма для запуску імпорту -->
        <form action="{{ route('acts.import.process') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Запустити імпорт</button>
        </form>
    </div>
@endsection
