<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('GigNego', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Nunito', sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 30px;
            text-align: center;
        }

        .login-card h2 {
            color: #4e73df;
        }

        .login-btn {
            background-color: #4e73df;
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .login-btn:hover {
            background-color: #375a8c;
        }

        .social-btn {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .social-btn a {
            padding: 10px 20px;
            background-color: #db4437;
            color: white;
            border-radius: 50px;
            font-size: 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .social-btn a:hover {
            background-color: #c1351d;
        }



        .sign-up-link {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #4e73df;
        }

        .sign-up-link:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h2>Welcome back</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="login-btn">Sign In</button>

            </form>

            <div class="social-btn">
                <a href="javascript:void(0);" onclick="socialSignin('google')">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google"
                        width="24" />
                    Sign in with Google
                </a>
            </div>

            <a href="{{ route('register') }}" class="sign-up-link">Don't have an account? Sign up</a>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-auth.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyCTUhRTkuOZnhD5ObWrKrbRk5L2GIH0MjE",
            authDomain: "chatapptest-42824.firebaseapp.com",
            projectId: "chatapptest-42824",
            storageBucket: "chatapptest-42824.firebasestorage.app",
            messagingSenderId: "320062069119",
            appId: "1:320062069119:web:299f929ce78274c26e624a"
        };
        firebase.initializeApp(firebaseConfig);
        var facebookProvider = new firebase.auth.FacebookAuthProvider();
        var googleProvider = new firebase.auth.GoogleAuthProvider();

        async function socialSignin(provider) {
            var socialProvider = null;
            if (provider == "facebook") {
                socialProvider = facebookProvider;
            } else if (provider == "google") {
                socialProvider = googleProvider;
            } else {
                return;
            }

            firebase.auth().signInWithPopup(socialProvider).then(function(result) {
                result.user.getIdToken().then(function(result) {
                    document.getElementById('social-login-tokenId').value = result;
                    document.getElementById('social-login-form').submit();
                });
            }).catch(function(error) {
                console.log(error);
            });
        }
    </script>
</body>
