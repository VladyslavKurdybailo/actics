<!-- resources/views/acts/show.blade.php -->

@extends('layouts.app')

@section('content')
<h1>Акт перевірки № {{ $act->act_number }}</h1>
<p><strong>Дата:</strong> {{ $act->date }}</p>
<p><strong>Замовник:</strong> {{ $act->customer_name }}</p>
<p><strong>Адреса:</strong> {{ $act->object_address }}</p>
<p><strong>Результат:</strong> {{ $act->conclusion }}</p>


@if (!$act->signed_pdf_path) <!-- Якщо акт не підписано -->
<h3>Завантажити АКТ:</h3>
<a href="{{ asset('storage/acts/' . basename($act->pdf_path)) }}" download>Завантажити Акт на підпис</a>
@endif

<h3>QR-код:</h3>
<img src="{{ asset('storage/qrcodes/' . basename($act->qr_code)) }}" alt="QR-код">

@if ($act->signed_pdf_path) <!-- Якщо акт підписано -->
<h3>Акт підписано</h3>
<p>Переглянути підписаний акт:</p>
<a href="{{ asset('storage/signed_acts/' . basename($act->signed_pdf_path)) }}" download>Завантажити підписаний акт</a>
@else <!-- Якщо акт не підписано -->
<h3>Завантажити підписаний акт:</h3>
<form action="{{ route('acts.uploadSigned', $act->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="signed_pdf" required>
    <button type="submit">Завантажити підписаний акт</button>
</form>
@endif
@endsection
