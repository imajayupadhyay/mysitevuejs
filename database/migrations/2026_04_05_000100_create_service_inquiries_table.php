<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('service', 160);
            $table->string('name', 120);
            $table->string('email', 160);
            $table->string('phone', 40)->nullable();
            $table->string('company', 160)->nullable();
            $table->string('budget', 40)->nullable();
            $table->string('timeline', 40)->nullable();
            $table->text('details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_inquiries');
    }
};
