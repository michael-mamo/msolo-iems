<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMySavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_savings', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('title'); 
            $table->date('date');
            $table->integer('savingtypeid');
            $table->string('savingfor')->nullable();
            $table->double('amount', 15, 2)->nullable(); 
            $table->double('targetamount', 15, 2)->nullable();
            $table->string('status');  
            $table->string('description')->nullable();
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
        Schema::dropIfExists('my_savings');
    }
}
