<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedoCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('comments');
 
       Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('entity_id')->unsigned();
            $table->string('entity_type');
            $table->longText('text')->nullable();
            $table->longText('html')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('local_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

            $table->index(['entity_id', 'entity_type']);
            $table->index(['local_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
