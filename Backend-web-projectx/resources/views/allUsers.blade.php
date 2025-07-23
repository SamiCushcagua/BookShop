@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Sección: Crear nuevo usuario (solo para admins) --}}
    @auth
        @if(auth()->user()->admin)
            <div class="profile-section">
                <h2>Crear Nuevo Usuario</h2>
                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="profile-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fname">First name:</label>
                            <input type="text" id="fname" name="fname" value="{{ old('fname') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="lname">Last name:</label>
                            <input type="text" id="lname" name="lname" value="{{ old('lname') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="birthdate">Birthdate:</label>
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="about">About:</label>
                        <textarea id="about" name="about">{{ old('about') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <small>Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="admin">Admin:</label>
                        <select id="admin" name="admin" required>
                            <option value="0" {{ old('admin') == '0' ? 'selected' : '' }}>user</option>
                            <option value="1" {{ old('admin') == '1' ? 'selected' : '' }}>admin</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </div>
                </form>
            </div>
        @endif
    @endauth

    {{-- Sección: Lista de usuarios --}}
    <div class="profile-section">
        <h2>Lista de Usuarios</h2>
        
        @if(isset($users) && $users->count() > 0)
            <div class="users-grid">
                @foreach($users as $user)
                    <div class="user-card">
                        <div class="user-header">
                            {{-- Solo la imagen es clickeable --}}
                            <a href="{{ route('profiel', ['user' => $user->id]) }}" class="user-image-link">
                                @if($user->image)
                                    <img src="{{ Storage::url($user->image) }}" alt="User image" class="user-image">
                                @else
                                    <div class="user-placeholder">
                                        <span>{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </a>
                            <div class="user-info">
                                <h3>{{ $user->name }}</h3>
                                <span class="role-badge {{ $user->admin ? 'admin' : 'user' }}">
                                    {{ $user->admin ? 'Admin' : 'User' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="user-details">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            @if($user->birthdate)
                                <p><strong>Birthdate:</strong> {{ $user->birthdate }}</p>
                            @endif
                            @if($user->about)
                                <p><strong>About:</strong> {{ Str::limit($user->about, 100) }}</p>
                            @endif
                        </div>
                        
                        {{-- Solo administradores pueden ver estos botones --}}
                        @auth
                            @if(auth()->user()->admin)
                                <div class="user-actions">
                                    {{-- Formulario para cambiar rol --}}
                                    <form method="POST" action="{{ route('users.toggle-role', $user) }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="admin" value="{{ $user->admin ? '0' : '1' }}">
                                        <button type="submit" class="btn btn-sm {{ $user->admin ? 'btn-warning' : 'btn-success' }}" 
                                                onclick="return confirm('¿Estás seguro de que quieres cambiar el rol de este usuario?')">
                                            {{ $user->admin ? 'Quitar Admin' : 'Hacer Admin' }}
                                        </button>
                                    </form>
                                    
                                    {{-- Formulario para eliminar --}}
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
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
                <p>No hay usuarios registrados.</p>
            </div>
        @endif
    </div>
</div>
@endsection