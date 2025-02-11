@extends('layouts.app')

@section('title', 'Détails de l\'offre')

@section('css')
    <link href="{{ asset('css/groovie.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="cards-container ">
    <div id="profil-card" class="card detail_container" data-index="1">
        <div class="card-header detail_img">
        
        <h1><span>-{{ $offre->reduction_en_pourcentage }}% </span>{{ $offre->nom_offre }} pour {{$offre->points_groovie}} groovies</h1>
        </div>    
            <div class="offer-detail-container">
                <h2>{{ $offre->nom_offre }}</h2> 
                
                <div class="offer-detail">
                    
                    <p>Sur un trajet proposé par <span>{{ $offre->partenaire->nom }}</span> </p> 
                    <p>{{ $offre->informations_offre }}</p>
                    <p>{{ $offre->conditions_offre }}</p>
                </div>
                <div class="offer-actions">
                <form action="{{ route('offre.utiliser', $offre->id) }}" method="POST">
            @csrf 
            <button type="submit" class="use-offer">Utiliser l'offre</button>
        </form>
                    <a href="{{ url()->previous() }}" class="back-button">Retour</a>
                </div>
                </div>
            
    </div>
</div>



@endsection