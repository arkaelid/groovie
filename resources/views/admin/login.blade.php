<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        :root {
            --midnight-blue: #000b58;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-sizing: border-box; /* Inclut le padding dans la largeur */
        }

        .login-container h2 {
            margin-bottom: 24px;
            color: var(--midnight-blue);
            font-size: 24px;
        }

        .login-container .form-group {
            margin-bottom: 16px;
            position: relative;
        }

        .login-container .form-group input {
            width: 100%;
            height: 48px;
            background-color: rgba(0, 11, 88, 0.08);
            border: none;
            border-radius: 12px;
            padding: 0 16px 0 48px; /* Padding à gauche pour l'icône */
            color: var(--midnight-blue);
            font-size: 15px;
            box-sizing: border-box; /* Inclut le padding dans la largeur */
        }

        .login-container .form-group input::placeholder {
            color: var(--midnight-blue);
            opacity: 0.7;
        }

        .login-container .form-group .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            opacity: 0.7;
            pointer-events: none;
            color: var(--midnight-blue);
        }

        .login-container button {
            width: 100%;
            height: 48px;
            background-color: var(--midnight-blue);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 16px;
        }

        .login-container button:hover {
            background-color: #00094d;
        }

        .login-container a {
            color: var(--midnight-blue);
            text-decoration: none;
            display: block;
            margin-top: 16px;
            font-size: 14px;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <h3 style="color:red">{{ session('error') }}</h3>
                    </div>
                @endif
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Identifiant">
                @error('email')
                    <strong>{{ $message }}</strong>
                @enderror
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2z"/>
                </svg>
            </div>
            <div class="form-group">
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                @enderror
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zM5 10v8h14v-8H5zm6 4h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2zm1-6V7a4 4 0 1 0-8 0v1h8z"/>
                </svg>
            </div>
            <button type="submit">Connexion</button>
        </form>
    </div>
</body>
