<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    // Título del libro
            $table->string('author');                   // Autor
            $table->text('description')->nullable();    // Descripción del libro
            $table->decimal('price', 8, 2);            // Precio (8 dígitos, 2 decimales)
            $table->integer('stock')->default(1);       // Cantidad disponible
            $table->string('isbn')->nullable();         // ISBN del libro
            $table->string('publisher')->nullable();    // Editorial
            $table->integer('publication_year')->nullable(); // Año de publicación
            $table->string('condition')->nullable(); // Estado del libro (new, good, fair, poor)
            $table->string('cover_image')->nullable();  // Imagen de la portada
            $table->string('category')->nullable();     // Categoría (ficción, no-ficción, etc.)
            $table->string('language')->nullable();  // Idioma
            $table->boolean('is_available')->default(true); // Disponible para venta
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que vende el libro
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};