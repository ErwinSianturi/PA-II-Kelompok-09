<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            max-width: 1200px;
        }

        .login-box {
            display: flex;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .login-form {
            padding: 30px;
            width: 50%;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            font-size: 14px;
            margin-bottom: 25px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #7F56D9;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #6d4cd1;
        }

        .links {
            text-align: center;
            margin-top: 10px;
        }

        .links a {
            font-size: 14px;
            color: #7F56D9;
            text-decoration: none;
        }

        .illustration {
            width: 50%;
            background-color: #7F56D9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .illustration img {
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="login-form">
                <h2>Create Account</h2>
                <p>Fill in your details to create a new account</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="login-btn">Register</button>
                </form>

                <div class="links">
                    <a href="{{ route('login') }}">Already have an account? Sign in</a>
                </div>
            </div>
            <div class="illustration">
                <!-- Include your desired illustration here -->
                @include('items.toak')
            </div>
        </div>
    </div>
</body>
</html>
