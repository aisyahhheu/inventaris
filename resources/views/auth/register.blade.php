<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Kode CSS Anda tetap sama */
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

        .register-box {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
            padding: 40px;
            width: 380px;
            text-align: center;
        }
        .register-box img {
            max-width: 160px;
            margin-bottom: 20px;
        }
        .register-box h3 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 12px;
        }
        .btn-register {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            transition: 0.3s;
        }
        .btn-register:hover {
            background-color: #0056b3;
        }
        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }
        .login-link a {
            text-decoration: none;
            font-weight: 600;
            color: #007bff;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="register-box">
        <img src="lldikti-logo.png" alt="Logo LLDIKTI 2">
         <h3>Register</h3>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" class="form-control" name="name" placeholder="Name" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <input type="email" class="form-control" name="email" placeholder="Email" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <input type="password" class="form-control" name="password" placeholder="Password" required>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-register">Register</button>
    </form>
    <div class="login-link">
        already have an account? <a href="{{ route('login') }}">Login</a>
    </div>
</div>
</body>
</html>