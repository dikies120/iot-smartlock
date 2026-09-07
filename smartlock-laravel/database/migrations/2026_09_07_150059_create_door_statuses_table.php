<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('door_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status'); 
            $table->timestamp('updated_at')->useCurrent();
        });
    }

public function down(): void
    {
        Schema::dropIfExists('door_statuses');
    }
};
