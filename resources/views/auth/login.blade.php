<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('/foto-kantor.jpg') no-repeat center center/cover;
            font-family: Arial, sans-serif;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 50, 100, 0.5);
            z-index: 1;
        }

        .login-box {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 380px;
            text-align: center;
        }

        .login-box img {
            max-width: 160px;
            margin-bottom: 20px;
        }

        .login-box h3 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 12px;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .forgot-password-link {
            text-align: right;
            margin-bottom: 15px;
        }

        .forgot-password-link a {
            font-size: 14px;
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
        }

        .forgot-password-link a:hover {
            text-decoration: underline;
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            text-decoration: none;
            font-weight: 600;
            color: #007bff;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="login-box">
        <img src="{{ asset('lldikti-logo.png') }}" alt="Logo LLDIKTI 2">
        <h3>Login</h3>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>

            <input type="password" class="form-control" name="password" placeholder="Password" required>

            <div class="forgot-password-link">
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-login">Login</button>
            <div class="register-link">
                Dont have an account? <a href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </div>
</body>

</html>