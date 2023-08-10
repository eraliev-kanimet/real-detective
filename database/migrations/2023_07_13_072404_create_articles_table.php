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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->integer('read_time');
            $table->foreignId('author_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image');
            $table->text('description');
            $table->json('tags');
            $table->json('content');
            $table->json('faq');
            $table->json('seo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
