<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_receivables', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('borrower');
            $table->date('date');
            $table->integer('receivabletypeid');
            $table->double('amount', 15, 2)->nullable();
            $table->double('duration')->nullable();
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
        Schema::dropIfExists('my_receivables');
    }
}
