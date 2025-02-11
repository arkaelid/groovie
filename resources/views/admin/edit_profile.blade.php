@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-primary mb-4">Modifier Mon Profil</h1>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white">
                        Modifier mes informations
                    </div>
                    <div class="card-body">
                        <!-- Formulaire pour le nom -->
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Formulaire pour l'email -->
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-success btn-lg w-100 mt-4">Mettre à jour</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
