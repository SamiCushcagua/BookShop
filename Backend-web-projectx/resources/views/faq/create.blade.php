@extends('layouts.app')

@section('content')
<div class="faq-form">
    <h2>Agregar Nueva Pregunta FAQ</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('faq.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="category_id">Categoría *</label>
            <select name="category_id" id="category_id" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="question">Pregunta *</label>
            <textarea name="question" id="question" required>{{ old('question') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="answer">Respuesta *</label>
            <textarea name="answer" id="answer" required>{{ old('answer') }}</textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Crear Pregunta</button>
            <a href="{{ route('faq.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection