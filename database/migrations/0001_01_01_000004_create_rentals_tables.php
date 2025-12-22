<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; // <--- THIS IS THE MISSING PIECE
use Illuminate\Support\Facades\Schema;    // <--- THIS IS ALSO REQUIRED

return new class extends Migration
{
    public function up(): void
    {
		Schema::create('rentals', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained();
			$table->foreignId('item_id')->constrained();
			$table->date('start_date');
			$table->date('end_date');
			$table->enum('status', ['pending', 'active', 'returned', 'cancelled'])->default('pending');
			$table->decimal('total_price', 10, 2);
			$table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};