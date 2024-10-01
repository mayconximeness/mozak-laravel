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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_code')->default(DB::raw('(UUID())'));
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Relacionamento com o usuário
            $table->string('name');
            $table->string('description');
            $table->string('address');
            $table->string('complement')->nullable();
            $table->string('zipcode');
            $table->string('number');
            $table->string('city');
            $table->string('state');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->integer('max_subscription')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps(); // created_at e updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
