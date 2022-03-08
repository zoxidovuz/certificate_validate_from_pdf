<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            $table->text('name_society')->comment('This is column for name certificate');
            $table->tinyInteger('type')->comment('Type of certificate');
            $table->date('date_certificate')->comment('Valid date of certificate');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
