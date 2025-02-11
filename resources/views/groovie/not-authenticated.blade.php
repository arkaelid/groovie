@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="main-content">
        <div class="auth-required-container">
            <div class="auth-required-content">
                <h1>Connectez-vous pour accéder à Groovie</h1>
                <p>Pour profiter de toutes les fonctionnalités de Groovie, veuillez vous connecter ou créer un compte.</p>
                <div class="auth-buttons">
                    <a href="#" class="btn-connexion" onclick="openLoginModal()">Connexion</a>
                    <a href="#" class="btn-inscription" onclick="openRegisterModal()">Inscription</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .auth-required-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
        padding: 2rem;
    }

    .auth-required-content {
        text-align: center;
        background: var(--midnight-blue);
        padding: 3rem;
        border-radius: 20px;
        max-width: 500px;
        width: 100%;
    }

    .auth-required-content h1 {
        color: white;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .auth-required-content p {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
    }

    .auth-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn-connexion, .btn-inscription {
        padding: 0.75rem 2rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.3s ease;
    }

    .btn-connexion {
        background: var(--violette);
        color: white;
    }

    .btn-inscription {
        background: white;
        color: var(--midnight-blue);
    }

    .btn-connexion:hover, .btn-inscription:hover {
        transform: translateY(-2px);
    }
</style>
@endsection 