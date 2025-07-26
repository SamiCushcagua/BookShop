@extends('layouts.app')

@section('content')
<div class="faq-form">
    <h2>Agregar Nueva Categoría FAQ</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('faq.store-category') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Nombre de la Categoría *</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Descripción (opcional)</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Crear Categoría</button>
            <a href="{{ route('faq.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection