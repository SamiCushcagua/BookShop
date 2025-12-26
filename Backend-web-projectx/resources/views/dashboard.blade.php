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
                        
                            @if($book->cover_image)
                                <a class="user-image-link">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Portada" class="book-image">
                                </a>
                            @else
                                <div class="user-placeholder">
                                    <span>No hay imagen</span>
                                </div>
                            @endif
                       
                        <div class="user-info">
                            <h2>{{ $book->title }}</h2>
                            
                        </div>
                    </div>
                    
                    <div class="user-details">
                        <p><strong>Autor:</strong> {{ $book->author }}</p>
                        
                        @if($book->condition)
                            <p><strong>Condición:</strong> {{ $book->condition }}</p>
                        @endif

                        @if($book->price)
                            <p><strong>Precio:</strong> €{{ $book->price }}</p>
                        @endif

                        @if($book->stock)
                            <p><strong>Stock:</strong> {{ $book->stock }}</p>
                        @endif  

                        @if($book->publication_year)
                            <p><strong>Año de publicación:</strong> {{ $book->publication_year }}</p>
                        @endif

                        @if($book->isbn)
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                        @endif  

                        @if($book->category)
                            <p><strong>Categoría:</strong> {{ $book->category }}</p>
                        @endif

                        @if($book->language)
                            <p><strong>Idioma:</strong> {{ $book->language }}</p>
                        @endif

                        @if($book->is_available)
                            <p><strong>Disponibilidad:</strong> {{ $book->is_available ? 'Disponible' : 'No disponible' }}</p>
                        @endif

                        @if($book->description)
                            <p><strong>Descripción:</strong> {{ $book->description }}</p>
                        @endif

                       
                        
                    </div>



                    
                    @auth

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
                    @endauth
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