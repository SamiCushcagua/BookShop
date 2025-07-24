@extends('layouts.app')

@section('content')
<div class="faq-admin">
    <h1>Administrar FAQ</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Formulario para agregar categoría -->
    <div class="admin-section">
        <h2>Agregar Nueva Categoría</h2>
        <form method="POST" action="{{ route('faq.store-category') }}" class="admin-form">
            @csrf
            <div class="form-group">
                <label for="name">Nombre de la Categoría:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Categoría</button>
        </form>
    </div>
    
    <!-- Formulario para agregar pregunta -->
    <div class="admin-section">
        <h2>Agregar Nueva Pregunta</h2>
        <form method="POST" action="{{ route('faq.store') }}" class="admin-form">
            @csrf
            <div class="form-group">
                <label for="category_id">Categoría:</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="question">Pregunta:</label>
                <input type="text" name="question" id="question" required>
            </div>
            <div class="form-group">
                <label for="answer">Respuesta:</label>
                <textarea name="answer" id="answer" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Pregunta</button>
        </form>
    </div>
    
    <!-- Lista de categorías y preguntas existentes -->
    <div class="admin-section">
        <h2>FAQ Actual</h2>
        @if($categories->count() > 0)
            @foreach($categories as $category)
                <div class="category-item">
                    <h3>{{ $category->name }}</h3>
                    @if($category->description)
                        <p class="category-desc">{{ $category->description }}</p>
                    @endif
                    
                    @if($category->questions->count() > 0)
                        <div class="questions-list">
                            @foreach($category->questions as $question)
                                <div class="question-item">
                                    <div class="question-content">
                                        <strong>P: {{ $question->question }}</strong>
                                        <p>A: {{ $question->answer }}</p>
                                    </div>
                                    <div class="question-actions">
                                        <form method="POST" action="{{ route('faq.destroy', $question) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('¿Eliminar esta pregunta?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="no-questions">No hay preguntas en esta categoría.</p>
                    @endif
                    
                    <div class="category-actions">
                        <form method="POST" action="{{ route('faq.destroy-category', $category) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Eliminar esta categoría y todas sus preguntas?')">
                                Eliminar Categoría
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>No hay categorías creadas.</p>
        @endif
    </div>
    
    <div class="admin-actions">
        <a href="{{ route('faq.index') }}" class="btn btn-secondary">Ver FAQ Público</a>
    </div>
</div>
@endsection