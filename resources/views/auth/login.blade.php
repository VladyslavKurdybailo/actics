<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Підключаємо CSS файл -->
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>Увійти</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Поле для email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" autocomplete="username" />
                @error('email')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Поле для паролю -->
            <div class="form-group mt-4">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required class="form-control" autocomplete="current-password" />
                @error('password')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>



            <div class="form-group mt-4">
                <button type="submit" class="login-btn">Увійти</button>
            </div>


        </form>
    </div>
</div>

</body>
</html>
