<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusLogTable extends Migration
{
    
    public function up()
    {
        Schema::create('status_log', function (Blueprint $table) {
            $table->unsignedInteger('new_status_id');
            $table->unsignedInteger('old_status_id');
            $table->unsignedInteger('todoitem_id');
            $table->text('status_change_reason')->nullable();
            $table->foreign('new_status_id')->references('id')->on('status');
            $table->foreign('old_status_id')->references('id')->on('status');
            $table->foreign('todoitem_id')->references('id')->on('todoitem');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_log');
    }
}
