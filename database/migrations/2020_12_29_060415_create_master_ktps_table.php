<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_ktps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_ktp')->unique();
            $table->string('nama');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir')->nullable();
            $table->string('jns_kel');
            $table->text('alamat');
            $table->integer('kab_kota');
            $table->integer('prov');
            $table->string('agama');
            $table->string('status');
            $table->string('pekerjaan');
            $table->string('warga');
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_ktps');
    }
}
