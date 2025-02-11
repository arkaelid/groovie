@extends('admin.layoutadmin')

@section('title', 'Groovie - Fiche Actualité')

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
            max-height: 300px; /* Hauteur fixe pour éviter que la div s'étende trop */
            overflow-y: auto;  /* Active la barre de défilement verticale */
            padding-right: 10px; /* Évite que le texte soit collé à la scrollbar */
            display: flex;
            flex-direction: column;
            gap: 10px; /* Ajoute un espacement entre chaque card */
        }

        /* Style des cartes */
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

        /* Personnalisation de la scrollbar */
        .offers-container::-webkit-scrollbar {
            width: 8px;
        }

        .offers-container::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 4px;
        }

        .offers-container::-webkit-scrollbar-track {
            background: #f1f1f1;
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
            <h3>Informations actualité</h3>
            <h4 style="display: margin-left: 20px; padding: 5px 10px; border-radius: 5px; color:green";>
                @if(session('msg'))
                    {{ session('msg') }}                
                @endif
            </h4>
            <form action="{{ route('admin.actualite.update', $actualite) }}" method="POST">
                @method('PUT') <!-- Utilisation correcte de la méthode PUT pour une mise à jour -->
                @csrf
            
                <div class="form-group">
                    <label for="descriptif">Descriptif :</label>
                    <input type="text" id="descriptif" name="descriptif" value="{{ old('descriptif', $actualite->descriptif) }}" required>
                    @error('descriptif') <!-- Gestion des messages d'erreur -->
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nom">Nom créateur :</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $actualite->nom) }}" required>
                    @error('nom')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">type :</label>
                    <input type="type" id="type" name="type" value="{{ old('type', $actualite->type) }}" required>
                    @error('type')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="display: flex; gap: 400px; margin-top: 20px;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Mettre à jour</button>
            </form>
            <form action="{{ Route ('admin.actualite.delete', $actualite) }}" method="POST" style="display: inline-block;">
                @method('DELETE') <!-- Utilisation de la méthode DELETE pour la suppression -->
                @csrf
                <button type="submit" class="btn-primary" style="background-color: red; border-color: red;">Supprimer</button>
            </form>
            </div>
        </div>

        <!-- Carte des offres -->
        <div class="user-offers">
            <h3>Festivals associés</h3>
            @if($actualite->festivals->isEmpty())
                <p>Aucune festival associé à cette actualité.</p>
            @else
                <div class="offers-container">
                    @foreach($actualite->festivals as $festival)
                        <div class="offer-card">
                            <strong>{{ $festival->nom_festival }}</strong>
                            <span>Prix : {{ $festival->prix }}</span>
                            <span>lieu : {{ $festival->lieu_festival }}</span>
                            <span>Date de début : {{ $festival->date_heure_debut->translatedFormat('d F Y') ?? 'Non spécifiée' }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
@endsection