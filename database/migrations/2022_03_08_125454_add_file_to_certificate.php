<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToCertificate extends Migration
{
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('file', 255)->nullable()->comment('Pdf file certificate');
            $table->string('vat', 255)->nullable()->comment('Vat');
        });
    }

    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
}
