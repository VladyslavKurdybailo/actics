<!-- resources/views/acts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Список актів</h1>

    <!-- Таблиця для відображення актів -->
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Номер акту</th>
            <th>Замовник</th>
            <th>Результат</th>
            <th>Статус</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($acts as $act)
            <tr>
                <td>{{ $act->id }}</td>
                <td>{{ $act->act_number }}</td>
                <td>{{ $act->customer_name }}</td>
                <td>{{ $act->conclusion }}</td>
                <td>
                    @if ($act->signed_pdf_path)
                        <span style="color: green;">Підписано</span>
                    @else
                        <span style="color: red;">Не підписано</span>
                    @endif
                </td>
                <td>
                    <!-- Кнопка для перегляду акту -->
                    <a href="{{ route('acts.show', $act->id) }}">Переглянути</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
