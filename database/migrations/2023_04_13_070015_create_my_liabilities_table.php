<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyLiabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_liabilities', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('lender');
            $table->date('date');
            $table->integer('liabilitytypeid');
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
        Schema::dropIfExists('my_liabilities');
    }
}
