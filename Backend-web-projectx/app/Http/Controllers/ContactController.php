<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'email_message' => 'required|string|max:2000',
        ]);

        // Datos para el email
        $data = [
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'email_message' => $validated['email_message'],
        ];

        // Email del admin (ajusta esto a tu email real)
        $adminEmail = 'thecpatelier@gmail.com';

        // Enviar el email
        Mail::send('emails.contact', $data, function($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('Nieuw contactformulier bericht');
        });

        // Redirigir con mensaje de éxito
        return redirect()->route('contact_form')->with('success', 'Bedankt voor je bericht! We nemen zo snel mogelijk contact op.');
    }
}