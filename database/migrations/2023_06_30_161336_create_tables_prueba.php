<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesPrueba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('todo_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->boolean('active')->default(true);

            $table->unsignedInteger('fk_id_state');
            $table->unsignedInteger('fk_id_user');

            $table->foreign('fk_id_state')
                ->references('id')
                ->on('state');

            $table->foreign('fk_id_user')
                ->references('id')
                ->on('user');

            $table->timestamps();
        });

        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);

            $table->unsignedInteger('fk_id_state');
            $table->unsignedInteger('fk_id_todo_list');

            $table->foreign('fk_id_state')
                ->references('id')
                ->on('state');

            $table->foreign('fk_id_todo_list')
                ->references('id')
                ->on('todo_list');

            $table->timestamps();
        });

        Schema::create('step', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);

            $table->unsignedInteger('fk_id_state');
            $table->unsignedInteger('fk_id_task');

            $table->foreign('fk_id_state')
                ->references('id')
                ->on('state');

            $table->foreign('fk_id_task')
                ->references('id')
                ->on('task');

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
        Schema::dropIfExists('state');
        Schema::dropIfExists('user');
        Schema::dropIfExists('todo_list');
        Schema::dropIfExists('task');
        Schema::dropIfExists('step');
    }
}
