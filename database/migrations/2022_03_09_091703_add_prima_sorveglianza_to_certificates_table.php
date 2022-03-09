<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaSorveglianzaToCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->date('prima_sorveglianza')->nullable()->comment('Prima sorveglianza');
            $table->date('seconda_sorveglianza')->nullable()->comment('Seconda sorveglianza');
            $table->date('rinnovo')->nullable()->comment('Rinnovo');
            $table->tinyInteger('status')->default(0)->comment('Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            //
        });
    }
}
