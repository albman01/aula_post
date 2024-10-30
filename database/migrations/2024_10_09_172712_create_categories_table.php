<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CreateCategoriesTable extends Migration 
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        
        $categories = ['politica', 'tecnologia', 'sport', 'informatica'];

        foreach ($categories as $category) { // Correggi 'ad' in 'as'
            Category::create([
                'name' => $category
            ]); 
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
