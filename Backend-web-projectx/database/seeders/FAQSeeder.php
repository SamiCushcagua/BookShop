<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQCategory;
use App\Models\FAQQuestion;

class FAQSeeder extends Seeder
{
    public function run()
    {
        // Crear categorías
        $general = FAQCategory::create([
            'name' => 'General',
            'description' => 'Preguntas generales sobre nuestros servicios'
        ]);

        $technical = FAQCategory::create([
            'name' => 'Técnico',
            'description' => 'Preguntas técnicas y de soporte'
        ]);

        $sales = FAQCategory::create([
            'name' => 'Ventas',
            'description' => 'Preguntas sobre compras y ventas'
        ]);

        // Crear preguntas
        FAQQuestion::create([
            'category_id' => $general->id,
            'question' => '¿Cómo puedo contactar con soporte?',
            'answer' => 'Puedes contactarnos a través de nuestro formulario de contacto o enviando un email a soporte@ejemplo.com'
        ]);

        FAQQuestion::create([
            'category_id' => $general->id,
            'question' => '¿Cuáles son los horarios de atención?',
            'answer' => 'Nuestro horario de atención es de lunes a viernes de 9:00 AM a 6:00 PM'
        ]);

        FAQQuestion::create([
            'category_id' => $technical->id,
            'question' => '¿Qué navegadores son compatibles?',
            'answer' => 'Nuestro sitio es compatible con Chrome, Firefox, Safari y Edge en sus versiones más recientes.'
        ]);

        FAQQuestion::create([
            'category_id' => $technical->id,
            'question' => '¿Cómo puedo restablecer mi contraseña?',
            'answer' => 'Puedes restablecer tu contraseña haciendo clic en "Olvidé mi contraseña" en la página de login.'
        ]);

        FAQQuestion::create([
            'category_id' => $sales->id,
            'question' => '¿Cuáles son los métodos de pago aceptados?',
            'answer' => 'Aceptamos tarjetas de crédito, débito, transferencias bancarias y pagos en efectivo.'
        ]);

        FAQQuestion::create([
            'category_id' => $sales->id,
            'question' => '¿Ofrecen envío a domicilio?',
            'answer' => 'Sí, ofrecemos envío a domicilio en toda la ciudad con un costo adicional de $5.'
        ]);
    }
}