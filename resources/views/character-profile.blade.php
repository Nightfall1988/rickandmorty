@extends('layouts.app')

@section('content')
<div class="container">
    <div class="character-profile">
        <div class="card">
            <div class="data-wrapper">
                <img src="{{ $character['image'] }}" class="card-img-top" alt="{{ $character['name'] }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $character['name'] }}</h2>
                    <p class="card-text"><strong>Status:</strong> {{ $character['status'] }}</p>
                    <p class="card-text"><strong>Species:</strong> {{ $character['species'] }}</p>
                    <p class="card-text"><strong>Type:</strong> {{ $character['type'] ?? 'Unknown' }}</p>
                    <p class="card-text"><strong>Gender:</strong> {{ $character['gender'] }}</p>
                    <p class="card-text"><strong>Origin:</strong> {{ $character['origin']['name'] }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $character['location']['name'] }}</p>
                </div>
            </div>
            <div class="episode-wrapper">
                <div>
                    <p class="card-text"><strong>Appeared in:</strong></p>
                    <ul>
                        @foreach ($episodes as $episode)
                        <li class="card-text"> {{ $episode }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.card {
    display: flex;
}
.container {
    margin-top: 2rem;
}

.character-profile .card {
    max-width: 800px;
    margin: 0 auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    height: 300px;
    object-fit: cover;
}

.card-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.card-text {
    font-size: 1rem;
    margin-bottom: 0.5rem;
    color: #6c757d;
}

.data-wrapper, .episode-wrapper {
    padding: 2rem;
}
</style>
