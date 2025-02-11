

    <div class="festivals-grid">

    @foreach ($festivals as $festival)
        <a href="{{ route('festival.show', ['festival' => $festival->slug]) }}" class="festival-card">
            <div class="festival-info">
                <h3>{{ $festival->nom_festival }}</h3>
                <p class="festival-date">Du {{ $festival->date_heure_debut->translatedFormat('d') }} au {{ $festival->date_heure_fin->translatedFormat('d F Y') }}</p>
            </div>
            <div class="festival-logo">
                <img src="{{ asset('img/' . $festival->image_festival) }}" alt="Affiche {{ $festival->nom_festival }}">
            </div>
        </a>
    @endforeach

