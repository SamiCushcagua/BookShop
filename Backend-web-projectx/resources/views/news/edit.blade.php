@extends('layouts.app')

@section('content')

@if(Auth::user()->admin)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">   
                    <h1>Nieuwsitem wijzigen</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if($newsItem->image)
                        <div class="current-image" style="margin-bottom: 20px;">
                            <p><strong>Huidige afbeelding:</strong></p>
                            <img src="{{ asset('storage/' . $newsItem->image) }}" alt="Current image" style="max-width: 200px;">
                        </div>
                    @endif
                    
                    <form action="{{ route('news.update', $newsItem) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="title">Titel*</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $newsItem->title) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="image">Nieuwe afbeelding (optioneel):</label>
                            <input type="file" id="image" name="image" accept="image/*">
                            <small>Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="content">Content*</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $newsItem->content) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="publication_date">Publicatiedatum*</label>
                            <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ old('publication_date', $newsItem->publication_date->format('Y-m-d')) }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Nieuwsitem bijwerken</button>
                        <a href="{{ route('start') }}" class="btn btn-secondary">Annuleren</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@endsection