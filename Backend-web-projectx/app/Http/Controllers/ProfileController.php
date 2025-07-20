<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Mostrar página de perfil
    public function index(User $user = null)
    {
        // Si no se proporciona usuario, usar el usuario autenticado
        if (!$user) {
            $user = auth()->user();
        }
        
        // Obtener todos los usuarios para la gestión (solo si es admin)
        $users = auth()->user()->admin ? User::all() : collect();
        
        return view('profiel', compact('user', 'users'));
    }

    // Actualizar datos personales (sin imagen ni contraseña)
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validar los datos
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'birthdate' => 'nullable|date',
            'about' => 'nullable|string'
        ]);

        // Actualizar usuario
        $user->update([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'about' => $request->about
        ]);

        return redirect()->route('profiel')->with('success', 'Datos personales actualizados exitosamente');
    }

    // Actualizar imagen de perfil
    public function updateImage(Request $request)
    {
        $user = auth()->user();

        // Validar la imagen
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Eliminar imagen anterior si existe
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Guardar nueva imagen
        $imagePath = $request->file('image')->store('users', 'public');

        // Actualizar usuario
        $user->update([
            'image' => $imagePath
        ]);

        return redirect()->route('profiel')->with('success', 'Imagen de perfil actualizada exitosamente');
    }

    // Actualizar contraseña
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        // Validar los datos
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        // Verificar contraseña actual
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profiel')->with('error', 'La contraseña actual es incorrecta');
        }

        // Actualizar contraseña
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profiel')->with('success', 'Contraseña actualizada exitosamente');
    }
}