<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name');
            $table->boolean('active')->default(true);
            $table->text('status_description')->nullable();
            $table->string('color', 50)->nullable();
            $table->integer('priority')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('status');
    }
}
