@extends('layouts.app')

@section('content')

<div class="news-container">
    <div class="news-header">
        <h1>Laatste nieuwtjes</h1>
        <p class="news-subtitle">Blijf op de hoogte van het laatste nieuws uit onze boekwinkel</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
        @if(Auth::user()->admin)
            <div class="admin-actions-top">
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                    <span>➕</span> Nieuwe nieuwsitem toevoegen
                </a>
            </div>
        @endif
    @endauth

    @if(isset($newsItems) && $newsItems->count() > 0)
        <div class="news-grid">
            @foreach($newsItems as $newsItem)
                <div class="news-card">
                    <div class="news-card-image-wrapper">
                        @if($newsItem->image)
                            <a href="{{ route('news.show', $newsItem) }}">
                                <img src="{{ asset('storage/' . $newsItem->image) }}" 
                                     alt="{{ $newsItem->title }}" 
                                     class="news-card-image">
                            </a>
                        @else
                            <div class="news-placeholder">
                                <span>📰</span>
                                <p>Geen afbeelding</p>
                            </div>
                        @endif
                        <div class="news-card-date-badge">
                            {{ $newsItem->publication_date->format('d M') }}
                        </div>
                    </div>
                    
                    <div class="news-card-content">
                        <h2 class="news-card-title">
                            <a href="{{ route('news.show', $newsItem) }}">{{ $newsItem->title }}</a>
                        </h2>
                        
                        <p class="news-card-excerpt">
                            {{ Str::limit($newsItem->content, 120) }}
                        </p>
                        
                        <div class="news-card-footer">
                            <a href="{{ route('news.show', $newsItem) }}" class="btn-read-more">
                                Lees meer →
                            </a>
                            
                            @auth
                                @if(Auth::user()->admin)
                                    <div class="news-card-actions">
                                        <a href="{{ route('news.edit', $newsItem) }}" 
                                           class="btn-action btn-edit" 
                                           title="Wijzigen">
                                            ✏️
                                        </a>
                                        <form method="POST" 
                                              action="{{ route('news.destroy', $newsItem) }}" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Weet je zeker dat je dit nieuwsitem wilt verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn-action btn-delete" 
                                                    title="Verwijderen">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📰</div>
            <h3>Geen nieuwsitems beschikbaar</h3>
            <p>Er zijn momenteel geen nieuwsitems om weer te geven.</p>
            @auth
                @if(Auth::user()->admin)
                    <a href="{{ route('news.create') }}" class="btn btn-primary">
                        Voeg het eerste nieuwsitem toe
                    </a>
                @endif
            @endauth
        </div>
    @endif
</div>

@endsection