@extends('layouts.app')

@section('content')
<div class="faq-container">
    <h1>Preguntas Frecuentes</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($categories->count() > 0)
        @foreach($categories as $category)
            <div class="faq-category">
                <h2>{{ $category->name }}</h2>
                @if($category->description)
                    <p class="category-description">{{ $category->description }}</p>
                @endif
                
                <div class="faq-questions">
                    @foreach($category->questions as $question)
                        <div class="faq-item">
                            <h3 class="question">{{ $question->question }}</h3>
                            <div class="answer">
                                <p>{{ $question->answer }}</p>
                            </div>
                            
                            @auth
                                @if(auth()->user()->admin)
                                    <div class="admin-actions">
                                        <form method="POST" action="{{ route('faq.destroy', $question) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta pregunta?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-state">
            <p>No hay preguntas frecuentes disponibles.</p>
        </div>
    @endif
    
    @auth
        @if(auth()->user()->admin)
            <div class="admin-actions">
                <a href="{{ route('faq.create') }}" class="btn btn-primary">Agregar Pregunta</a>
                <a href="{{ route('faq.create-category') }}" class="btn btn-secondary">Agregar Categoría</a>
            </div>
        @endif
    @endauth
</div>
@endsection