@extends('layouts.app')

@section('content')

<div class="news-detail">
    <a href="{{ route('start') }}" class="btn btn-secondary" style="margin-bottom: 20px;">← Terug naar nieuwtjes</a>
    
    <article class="news-article">
        @if($newsItem->image)
            <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="news-detail-image">
        @endif
        
        <h1>{{ $newsItem->title }}</h1>
        
        <p class="news-meta">
            <strong>Publicatiedatum:</strong> {{ $newsItem->publication_date->format('d/m/Y') }}
        </p>
        
        <div class="news-content-full">
            <p>{{ $newsItem->content }}</p>
        </div>
        
        @auth
            @if(Auth::user()->admin)
                <div class="admin-actions" style="margin-top: 20px;">
                    <a href="{{ route('news.edit', $newsItem) }}" class="btn btn-secondary">Wijzigen</a>
                    <form method="POST" action="{{ route('news.destroy', $newsItem) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Weet je zeker dat je dit nieuwsitem wilt verwijderen?')">
                            Verwijderen
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </article>
</div>

@endsection