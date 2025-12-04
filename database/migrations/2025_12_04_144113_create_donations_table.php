<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // Relasi ke users (1 user banyak donasi)
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Lokasi donasi wajib dipilih
            $table->foreignId('donation_location_id')
                ->constrained('donation_locations')
                ->onDelete('cascade');  // jika lokasi dihapus, donasi ikut hilang (bisa diganti restrict)

            // Field Input Form
            $table->string('donor_name');
            $table->string('phone');
            $table->text('address');

            $table->string('item_type');
            $table->enum('delivery_type', ['jemput', 'antar']);

            $table->text('item_description');

            // Foto opsional (max 3 foto)
            $table->json('photos')->nullable();

            // Status donasi
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])
                ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
