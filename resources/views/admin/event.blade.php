@extends('admin.layoutadmin')

@section('title', 'Groovie - Fiche Evenement')

@section('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            padding: 20px;
            background: #f9f9f9; /* Fond clair pour contraster */
            border-radius: 10px;
        }

        .user-info, .user-offers {
            flex: 1;
            min-width: 300px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .user-info h3, .user-offers h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #000b58;
            border-bottom: 2px solid rgb(177, 59, 167);
            padding-bottom: 5px;
        }

        .user-info form .form-group {
            margin-bottom: 20px;
        }

        .user-info label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .user-info input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .user-info input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .error {
            font-size: 12px;
            color: red;
            margin-top: 5px;
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 20px;
            color: #ffffff;
            background: #007bff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .offers-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Limiter à 2 cartes par ligne */
            gap: 15px;
            margin-top: 15px;
            max-height: 500px; /* Limite la hauteur du conteneur */
            overflow-y: auto; /* Permet le défilement vertical si nécessaire */
        }

        .offer-card {
            background-color: #fff9c4; /* Jaune clair */
            border: 1px solid #fdd835; /* Jaune vif */
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%; /* Prendre toute la hauteur disponible dans la carte */
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

        h4.success-message {
            color: green;
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background: #e6ffe6;
            border: 1px solid #66cc66;
            border-radius: 8px;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Formulaire festival -->
        <div class="user-info">
            <h3>Informations du festival <strong style='color:purple'>{{$festival->nom_festival}}</strong></h3>
            <h4 style="display: margin-left: 20px; padding: 5px 10px; border-radius: 5px; color:green";>
                @if(session('msg'))
                    {{ session('msg') }}                
                @endif
            </h4>
            <form action="{{Route ('admin.festival.edit', $festival) }}" method="POST">
            @method('PUT') <!-- Utilisation correcte de la méthode PUT pour une mise à jour -->
            @csrf

                <div class="form-group">
                    <label for="nom_festival">Nom du festival :</label>
                    <input type="text" id="nom_festival" name="nom_festival" value="{{ old('nom_festival', $festival->nom_festival) }}" required>
                    @error('nom_festival') <!-- Gestion des messages d'erreur -->
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input type="text" id="prix" name="prix" value="{{ old('prix', $festival->prix) }}" required>
                    @error('prix')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lieu_festival">Lieu :</label>
                    <input type="text" id="lieu_festival" name="lieu_festival" value="{{ old('lieu_festival', $festival->lieu_festival) }}" required>
                    @error('lieu_festival')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_heure_debut">Date de début :</label>
                    <input type="datetime-local" id="date_heure_debut" name="date_heure_debut" 
                            value="{{ old('date_heure_debut', \Carbon\Carbon::parse($festival->date_heure_debut)->format('Y-m-d\TH:i')) }}" 
                            required>
                    @error('date_heure_debut')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date_heure_fin">Date de fin :</label>
                    <input type="datetime-local" id="date_heure_fin" name="date_heure_fin" 
                            value="{{ old('date_heure_fin', \Carbon\Carbon::parse($festival->date_heure_fin)->format('Y-m-d\TH:i')) }}" 
                            required>
                    @error('date_heure_fin')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Remplacez la section des boutons par ceci -->
                <div style="display: flex; gap: 400px; margin-top: 20px;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Mettre à jour</button>
            </form>
            <form action="{{ Route ('admin.festival.delete', $festival) }}" method="POST" style="display: inline-block;">
                @method('DELETE') <!-- Utilisation de la méthode DELETE pour la suppression -->
                @csrf
                <button type="submit" class="btn-primary" style="background-color: red; border-color: red;">Supprimer</button>
            </form>
            </div>
        </div>

        <!-- Carte des offres -->
        <div class="user-offers">
            <h3>Trajets associés</h3>
            @if($festival->trajets->isEmpty())
                <p>Aucun trajet pour ce festival.</p>
            @else
                <div class="offers-container">
                    @foreach($festival->trajets as $trajet)
                        <div class="offer-card">
                            <strong>{{ $trajet->nom }}</strong>
                            <span>Points groovie : {{ $trajet->groovies }}</span>
                            <span>Lieu de départ : {{ $trajet->lieu_depart ?? "Aucune information." }}</span>
                            <span>Empreinte carbone : {{ $trajet->empreinte_carbone }}</span>
                            <span>Date d'utilisation : {{ $trajet->updated_at->translatedFormat('d F Y') ?? 'Non spécifiée' }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
@endsection