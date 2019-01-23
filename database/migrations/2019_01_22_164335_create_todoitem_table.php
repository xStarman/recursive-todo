<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoitemTable extends Migration
{
    public function up()
    {
        Schema::create('todoitem', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("parent_id")->nullable();
            $table->unsignedInteger('status_id');
            $table->string('todo_name');
            $table->boolean('active')->default(true);
            $table->text('todo_description')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->foreign('parent_id')->references('id')->on('todoitem');
            $table->foreign('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('todoitem');
    }
}
