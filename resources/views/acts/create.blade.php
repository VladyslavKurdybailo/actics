<!-- resources/views/acts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Створити новий акт</h1>
    <form action="{{ route('acts.create') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label>Акт номер:</label>
                <input type="text" name="act_number" class="form-control" required>

                <label>Тип перевірки:</label>
                <input type="text" name="check_type" class="form-control" required>

                <label>Місце складання акту (місто):</label>
                <input type="text" name="location" class="form-control" required>

                <label>Дата складання акту:</label>
                <input type="date" name="date" class="form-control" required>

                <label>Виконавець робіт:</label>
                <input type="text" name="executor" class="form-control" required>

                <label>Тип об'єкту:</label>
                <input type="text" name="object_type" class="form-control" required>

                <label>Адреса об'єкту:</label>
                <input type="text" name="object_address" class="form-control" required>

                <label>Кількість каналів:</label>
                <input type="text" name="channels_count" class="form-control" required>

                <label>Газовикористовуюче обладнання:</label>
                <input type="text" name="equipment" class="form-control" required>

                <label>Тип Замовника:</label>
                <input type="text" name="customer_type" class="form-control" required>

                <label>Назва Замовника:</label>
                <input type="text" name="customer_name" class="form-control" required>

                <label>Матеріал ДК:</label>
                <input type="text" name="dk_material" class="form-control">

                <label>Матеріал ДК (другий варіант):</label>
                <input type="text" name="dk_material_2" class="form-control">

                <label>Площа перерізу ДК1:</label>
                <input type="text" name="dk1_area" class="form-control">

                <label>Площа перерізу ДК2:</label>
                <input type="text" name="dk2_area" class="form-control">

                <label>Площа перерізу ВК1:</label>
                <input type="text" name="vk1_area" class="form-control">

                <label>Площа перерізу ВК2:</label>
                <input type="text" name="vk2_area" class="form-control">

                <label>Матеріал димовідвідної труби:</label>
                <input type="text" name="pipe_material" class="form-control">

                <label>Площа перерізу димовідвідної труби:</label>
                <input type="text" name="pipe_area" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Довжина вертикальної ділянки труби:</label>
                <input type="text" name="pipe_length" class="form-control">

                <label>Кількість поворотів труби:</label>
                <input type="text" name="pipe_turns" class="form-control">

                <label>Наявність та справність перетинки в димових каналах:</label>
                <input type="text" name="partition_condition" class="form-control">

                <label>Прохідність каналів та наявність тяги:</label>
                <input type="text" name="channel_condition" class="form-control">

                <label>Відокремленість каналів:</label>
                <input type="text" name="channel_separation" class="form-control">

                <label>Справність оголовка:</label>
                <input type="text" name="chimney_head" class="form-control">

                <label>Правильність розташування оголовка відносно даху:</label>
                <input type="text" name="chimney_position_roof" class="form-control">

                <label>Розташування оголовка із врахуванням зони вітрового підпору:</label>
                <input type="text" name="chimney_position_wind" class="form-control">

                <label>Відсутність тріщин на димових каналах:</label>
                <input type="text" name="chimney_cracks" class="form-control">

                <label>Відсутність тріщин на вентиляційних каналах:</label>
                <input type="text" name="ventilation_cracks" class="form-control">

                <label>Наявність «кишені» та люка для очищення:</label>
                <input type="text" name="cleaning_lid" class="form-control">

                <label>Величина тяги в ДК1:</label>
                <input type="text" name="draft_dk1" class="form-control">

                <label>Величина тяги в ДК2:</label>
                <input type="text" name="draft_dk2" class="form-control">

                <label>Величина тяги в ВК1:</label>
                <input type="text" name="draft_vk1" class="form-control">

                <label>Величина тяги в ВК2:</label>
                <input type="text" name="draft_vk2" class="form-control">
            </div>
        </div>

        <hr>

        <h4>Додаткові вимірювання</h4>
        <label>Перевірено засобом вимірювальної техніки (ЗВТ):</label>
        <input type="text" name="measuring_tool" class="form-control">

        <label>Серійний номер ЗВТ:</label>
        <input type="text" name="serial_number" class="form-control">

        <label>Дата останньої повірки ЗВТ:</label>
        <input type="date" name="last_check_date" class="form-control">

        <label>Кратність повітрообміну:</label>
        <input type="text" name="air_exchange" class="form-control">

        <label>Кратність повітрообміну перевірена ЗВТ:</label>
        <input type="text" name="air_exchange_verified" class="form-control">

        <label>Серійний номер ЗВТ для перевірки повітрообміну:</label>
        <input type="text" name="air_exchange_tool_serial" class="form-control">

        <label>Дата останньої повірки ЗВТ для повітрообміну:</label>
        <input type="date" name="air_exchange_tool_last_check" class="form-control">

        <hr>

        <h4>Рішення за результатами перевірки</h4>
        <label>Висновок про придатність:</label>
        <input type="text" name="conclusion" class="form-control">

        <label>Причина непридатності:</label>
        <input type="text" name="reason_unfit" class="form-control">

        <label>Тип Замовника у знахідному відмінку:</label>
        <input type="text" name="customer_type_accusative" class="form-control">

        <label>Відповідальний від власника проінформований про заборону використання газового обладнання:</label>
        <input type="text" name="owner_informed" class="form-control">

        <label>Дата заборони:</label>
        <input type="date" name="ban_date" class="form-control">

        <label>Представник Виконавця:</label>
        <input type="text" name="executor_rep" class="form-control">

        <label>Представник Замовника:</label>
        <input type="text" name="customer_rep" class="form-control">

        <button type="submit" class="btn btn-primary mt-3">Зберегти</button>
    </form>
@endsection
