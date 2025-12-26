@extends('layouts.app')

@section('content')

<h1>Laatste nieuwtjes</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@auth
    @if(Auth::user()->admin)
        <div class="admin-actions" style="margin-bottom: 20px;">
            <a href="{{ route('news.create') }}" class="btn btn-primary">Nieuwe nieuwsitem toevoegen</a>
        </div>
    @endif
@endauth

@if(isset($newsItems) && $newsItems->count() > 0)
    <div class="news-grid">
        @foreach($newsItems as $newsItem)
            <div class="news-card">
                @if($newsItem->image)
                    <a href="{{ route('news.show', $newsItem) }}">
                        <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="news-image">
                    </a>
                @else
                    <div class="news-placeholder">
                        <span>Geen afbeelding</span>
                    </div>
                @endif
                
                <div class="news-content">
                    <h2>
                        <a href="{{ route('news.show', $newsItem) }}">{{ $newsItem->title }}</a>
                    </h2>
                    <p class="news-date">Publicatiedatum: {{ $newsItem->publication_date->format('d/m/Y') }}</p>
                    <p class="news-excerpt">{{ Str::limit($newsItem->content, 150) }}</p>
                    <a href="{{ route('news.show', $newsItem) }}" class="btn btn-sm btn-primary">Lees meer</a>
                    
                    @auth
                        @if(Auth::user()->admin)
                            <div class="admin-actions" style="margin-top: 10px;">
                                <a href="{{ route('news.edit', $newsItem) }}" class="btn btn-sm btn-secondary">Wijzigen</a>
                                <form method="POST" action="{{ route('news.destroy', $newsItem) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Weet je zeker dat je dit nieuwsitem wilt verwijderen?')">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <p>Er zijn nog geen nieuwsitems.</p>
    </div>
@endif

@endsection