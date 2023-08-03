<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('produks', function (Blueprint $table) {
			$table->increments('id_produk');
			$table->unsignedInteger('kategori_id')->nullable();
			$table->unsignedInteger('pemasok_id')->nullable();
			$table->string('nama_produk');
			$table->integer('quantity')->nullable();
			$table->float('harga_per_pcs')->nullable();
			$table->timestamps();

			$table->foreign('kategori_id')->references('id_kategori')->on('kategori')->onDelete('SET NULL');
			$table->foreign('pemasok_id')->references('id_pemasok')->on('pemasok')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('produks');
	}
};
