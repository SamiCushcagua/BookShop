@extends('layouts.app')

@section('content')

<h1>Dashboard</h1>  

<div class="profile-section">
    <h2>Lista de libros</h2>
    
    @if(isset($books) && $books->count() > 0)
        <div class="users-grid">
            @foreach($books as $book)
                <div class="user-card">
                    <div class="user-header">
                        <a href="{{ route('books.show', $book->id) }}" class="user-image-link">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="Portada" class="user-image">
                            @else
                                <div class="user-placeholder">
                                    <span>{{ substr($book->title, 0, 1) }}</span>
                                </div>
                            @endif
                        </a>
                        <div class="user-info">
                            <h3>{{ $book->title }}</h3>
                            <span class="category-badge">{{ $book->category ?? 'Sin categoría' }}</span>
                        </div>
                    </div>
                    
                    <div class="user-details">
                        <p><strong>Autor:</strong> {{ $book->author }}</p>
                        @if($book->description)
                            <p><strong>Descripción:</strong> {{ $book->description }}</p>
                        @endif
                        @if($book->price)
                            <p><strong>Precio:</strong> ${{ $book->price }}</p>
                        @endif
                    </div>
                    
                    @if(auth()->user()->admin)
                        <div class="user-actions">
                            <form method="POST" action="{{ route('books.destroy', $book) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p>No hay libros registrados.</p>
        </div>
    @endif
</div>

@endsection