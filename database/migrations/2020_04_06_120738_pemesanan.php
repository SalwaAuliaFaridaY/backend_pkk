<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pemesan');
            $table->enum('layanan', array('cuci_helm', 'laundry_pakaian', 'laundry_pakaian+setrika', 'laundry_selimut/sprei/korden', 'laundry_selimut/sprei/korden+setrika', 'laundry_boneka', 'laundry_sepatu', 'setrika'));
            $table->date('tanggal_serah');
            $table->date('tanggal_ambil');
            $table->enum('kecamatan', array('Klojen', 'Blimbing', 'Kedungkandang', 'Lowokwaru', 'Sukun'));
            $table->string('alamat');
            $table->string('kontak', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}
