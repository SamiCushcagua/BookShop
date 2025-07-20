@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perfil de {{ $user->name }}</h1>

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

    {{-- Sección: Ver perfil actual --}}
    <div class="profile-section">
        <h2>Información del Usuario</h2>
        <div class="profile-card">
            <div class="profile-header">
                @if($user->image)
                    <img src="{{ Storage::url($user->image) }}" alt="Profile image" class="profile-image">
                @else
                    <div class="profile-placeholder">
                        <span>{{ substr($user->name, 0, 1) }}</span>
                    </div>
                @endif
                <div class="profile-info">
                    <h3>{{ $user->name }}</h3>
                    <span class="role-badge {{ $user->admin ? 'admin' : 'user' }}">
                        {{ $user->admin ? 'Admin' : 'User' }}
                    </span>
                </div>
            </div>
            
            <div class="profile-details">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                @if($user->birthdate)
                    <p><strong>Birthdate:</strong> {{ $user->birthdate }}</p>
                @endif
                @if($user->about)
                    <p><strong>About:</strong> {{ $user->about }}</p>
                @endif
                <p><strong>Miembro desde:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Solo mostrar formularios de edición si es el propio usuario --}}
    @if(auth()->id() === $user->id)
        {{-- Sección: Editar datos personales --}}
        <div class="profile-section">
            <h2>Editar Mis Datos Personales</h2>
            <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First name:</label>
                        <input type="text" id="fname" name="fname" value="{{ old('fname', explode(' ', $user->name)[0] ?? '') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="lname">Last name:</label>
                        <input type="text" id="lname" name="lname" value="{{ old('lname', explode(' ', $user->name)[1] ?? '') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}">
                </div>
                
                <div class="form-group">
                    <label for="about">About:</label>
                    <textarea id="about" name="about">{{ old('about', $user->about) }}</textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                </div>
            </form>
        </div>

        {{-- Sección: Cambiar imagen --}}
        <div class="profile-section">
            <h2>Cambiar Mi Imagen de Perfil</h2>
            <form method="POST" action="{{ route('profile.update-image') }}" enctype="multipart/form-data" class="profile-form">
                @csrf
                @method('PUT')
                
                <div class="current-image">
                    @if($user->image)
                        <img src="{{ Storage::url($user->image) }}" alt="Current image" class="preview-image">
                    @else
                        <div class="profile-placeholder">
                            <span>{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="image">Nueva imagen:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <small>Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Cambiar Imagen</button>
                </div>
            </form>
        </div>

        {{-- Sección: Cambiar contraseña --}}
        <div class="profile-section">
            <h2>Cambiar Mi Contraseña</h2>
            <form method="POST" action="{{ route('profile.update-password') }}" class="profile-form">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="current_password">Contraseña actual:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">Nueva contraseña:</label>
                    <input type="password" id="new_password" name="new_password" required>
                    <small>Mínimo 8 caracteres</small>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar nueva contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Cambiar Contraseña</button>
                </div>
            </form>
        </div>
    @endif

    {{-- Sección: Gestión de usuarios (solo para admins) --}}
    @if(auth()->user()->admin)
    <div class="profile-section">
        <h2>Gestión de Usuarios</h2>
        
        {{-- Formulario para crear nuevo usuario --}}
        <div class="create-user-section">
            <h3>Crear Nuevo Usuario</h3>
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="user-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="new_fname">First name:</label>
                        <input type="text" id="new_fname" name="fname" value="{{ old('fname') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_lname">Last name:</label>
                        <input type="text" id="new_lname" name="lname" value="{{ old('lname') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="new_email">Email:</label>
                    <input type="email" id="new_email" name="email" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">Password:</label>
                    <input type="password" id="new_password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="new_birthdate">Birthdate:</label>
                    <input type="date" id="new_birthdate" name="birthdate" value="{{ old('birthdate') }}">
                </div>
                
                <div class="form-group">
                    <label for="new_about">About:</label>
                    <textarea id="new_about" name="about">{{ old('about') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="new_image">Image:</label>
                    <input type="file" id="new_image" name="image" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label for="new_admin">Admin:</label>
                    <select id="new_admin" name="admin" required>
                        <option value="0" {{ old('admin') == '0' ? 'selected' : '' }}>user</option>
                        <option value="1" {{ old('admin') == '1' ? 'selected' : '' }}>admin</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">Crear Usuario</button>
            </form>
        </div>

        {{-- Lista de usuarios para gestionar --}}
        <div class="users-management">
            <h3>Gestionar Usuarios</h3>
            @if($users->count() > 0)
                <div class="users-grid">
                    @foreach($users as $userItem)
                        <div class="user-card">
                            @if($userItem->image)
                                <img src="{{ Storage::url($userItem->image) }}" alt="User image" class="user-image">
                            @endif
                            <h4>{{ $userItem->name }}</h4>
                            <p><strong>Email:</strong> {{ $userItem->email }}</p>
                            <p><strong>Role:</strong> 
                                <span class="role-badge {{ $userItem->admin ? 'admin' : 'user' }}">
                                    {{ $userItem->admin ? 'Admin' : 'User' }}
                                </span>
                            </p>
                            
                            <div class="user-actions">
                                {{-- Formulario para cambiar rol --}}
                                <form method="POST" action="{{ route('users.toggle-role', $userItem) }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="admin" value="{{ $userItem->admin ? '0' : '1' }}">
                                    <button type="submit" class="btn btn-sm {{ $userItem->admin ? 'btn-warning' : 'btn-success' }}" 
                                            onclick="return confirm('¿Estás seguro de que quieres cambiar el rol de este usuario?')">
                                        {{ $userItem->admin ? 'Quitar Admin' : 'Hacer Admin' }}
                                    </button>
                                </form>
                                
                                {{-- Formulario para eliminar --}}
                                <form method="POST" action="{{ route('users.destroy', $userItem) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No hay usuarios registrados.</p>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection