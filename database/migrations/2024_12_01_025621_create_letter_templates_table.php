<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('letter_templates', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('letter_id');
            $table->string('name');
            $table->string('email');
            $table->date('date');
            $table->timestamps();

            $table->foreign('letter_id')->references('id')->on('letters')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letter_templates');
    }
};
