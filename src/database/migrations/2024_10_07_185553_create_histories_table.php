<?php

use App\Enums\ActionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('model_id');
            $table->string('model_name');
            $table->json('before')->nullable();
            $table->json('after')->nullable();
            $table->enum('action', ActionEnum::values());
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
