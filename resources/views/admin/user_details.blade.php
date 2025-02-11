@extends('admin.layoutadmin')

@section('title', 'Groovie - Profil Client')

@section('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <style>
        .container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .user-info, .user-offers {
            flex: 1;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .user-info h3, .user-offers h3 {
            margin-bottom: 15px;
            color: #000b58;
        }

        .user-info form .form-group {
            margin-bottom: 15px;
        }

        .user-info label {
            font-weight: bold;
        }

        .user-info input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        .user-offers ul {
            list-style: none;
            padding: 0;
        }

        .user-offers ul li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .user-offers ul li:last-child {
            border-bottom: none;
        }

        .user-offers ul li span {
            display: block;
            font-size: 14px;
            color: #555;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 15px;
            color: #fff;
            background: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .offers-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .offer-card {
            background-color: #fff9c4; /* Jaune clair */
            border: 1px solid #fdd835; /* Jaune vif */
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .offer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .offer-card strong {
            font-size: 16px;
            color: #000b58; /* Bleu foncé */
            display: block;
            margin-bottom: 5px;
        }

        .offer-card span {
            display: block;
            font-size: 14px;
            color: #555;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Formulaire utilisateur -->
        <div class="user-info">
            <h3>Informations Utilisateur</h3>
            <h4 style="display: margin-left: 20px; padding: 5px 10px; border-radius: 5px; color:green";>
                @if(session('msg'))
                    {{ session('msg') }}                
                @endif
            </h4>
            <form action="{{ route('admin.user.update', $user) }}" method="POST">
                @method('PUT') <!-- Utilisation correcte de la méthode PUT pour une mise à jour -->
                @csrf

                <div class="form-group">
                    <label for="firstname">Prénom :</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                    @error('firstname') <!-- Gestion des messages d'erreur -->
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lastname">Nom :</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                    @error('lastname')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" value="{{ old('pseudo', $user->pseudo) }}" required>
                    @error('pseudo')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-primary">Mettre à jour</button>
            </form>
        </div>

        <!-- Carte des offres -->
        <div class="user-offers">
            <h3>Offres Utilisées</h3>
            @if($user->offres->isEmpty())
                <p>Aucune offre utilisée par cet utilisateur.</p>
            @else
                <div class="offers-container">
                    @foreach($user->offres as $offre)
                        <div class="offer-card">
                            <strong>{{ $offre->nom_offre }}</strong>
                            <span>Points groovie utilisés : {{ $offre->points_groovie }}</span>
                            <span>Informations : {{ $offre->informations_offre ?? "Aucune information." }}</span>
                            <span>Date d'utilisation : {{ $offre->pivot->updated_at->translatedFormat('d F Y') ?? 'Non spécifiée' }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
@endsection