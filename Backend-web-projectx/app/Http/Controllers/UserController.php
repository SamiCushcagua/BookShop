<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // READ - Mostrar lista de usuarios (para la ruta allUsers)
    public function index()
    {
        $users = User::all();
        return view('allUsers', compact('users'));
    }

    // CREATE - Guardar nuevo usuario
    public function store(Request $request)
    {
        // Solo admins pueden crear usuarios
        if (!auth()->user()->admin) {
            return redirect()->route('profiel')->with('error', 'No tienes permisos para crear usuarios');
        }

        // Validar los datos
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'birthdate' => 'nullable|date',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'admin' => 'required|in:0,1'
        ]);

        // Procesar la imagen si se subió
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
        }

        // Convertir el string a booleano
        $isAdmin = $request->admin === '1';

        // Crear el usuario
        User::create([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'about' => $request->about,
            'image' => $imagePath,
            'admin' => $isAdmin,
        ]);

        return redirect()->route('profiel')->with('success', 'Usuario creado exitosamente');
    }

    // Método para cambiar rol (usando formulario tradicional)
    public function toggleRole(Request $request, User $user)
    {
        // Verificar que el usuario actual es admin
        if (!auth()->user()->admin) {
            return redirect()->route('profiel')->with('error', 'No tienes permisos para realizar esta acción');
        }

        // No permitir que un admin se quite sus propios privilegios
        if ($user->id === auth()->id()) {
            return redirect()->route('profiel')->with('error', 'No puedes cambiar tu propio rol');
        }

        // Cambiar el rol
        $user->update([
            'admin' => $request->admin === '1'
        ]);

        return redirect()->route('profiel')->with('success', 'Rol de usuario actualizado correctamente');
    }

    // DELETE - Eliminar usuario
    public function destroy(User $user)
    {
        // Verificar que el usuario actual es admin
        if (!auth()->user()->admin) {
            return redirect()->route('profiel')->with('error', 'No tienes permisos para realizar esta acción');
        }

        // No permitir que un admin se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return redirect()->route('profiel')->with('error', 'No puedes eliminar tu propia cuenta');
        }

        // Eliminar imagen si existe
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Eliminar usuario
        $user->delete();

        return redirect()->route('profiel')->with('success', 'Usuario eliminado correctamente');
    }
}