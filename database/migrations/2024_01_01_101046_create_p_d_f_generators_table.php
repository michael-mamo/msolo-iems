<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePDFGeneratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_d_f_generators', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('portraitimage')->nullable();
            $table->string('fullimage')->nullable();
            $table->string('passportimage')->nullable();
            $table->string('relegion')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('placeofbirth')->nullable();
            $table->string('town')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->integer('children')->nullable();
            $table->double('weight', 15, 2)->nullable(); 
            $table->double('height', 15, 2)->nullable(); 
            $table->string('complexion')->nullable();
            $table->string('education')->nullable();
            $table->boolean('arabics')->default(0);
            $table->boolean('arabicw')->default(0);
            $table->boolean('arabicr')->default(0);
            $table->boolean('englishs')->default(0);
            $table->boolean('englishw')->default(0);
            $table->boolean('englishr')->default(0);
            $table->string('empcountry')->nullable();
            $table->string('empperiod')->nullable();
            $table->string('delala')->nullable();
            $table->boolean('driving')->default(0);
            $table->boolean('cooking')->default(0);
            $table->boolean('washing')->default(0);
            $table->boolean('cleaning')->default(0);
            $table->boolean('babyseat')->default(0);
            $table->boolean('sewing')->default(0);
            $table->string('appliedfor')->nullable();
            $table->string('salary')->nullable();
            $table->string('contactperiod')->nullable();
            $table->string('passportnumber')->nullable();
            $table->date('pdate')->nullable();
            $table->string('pplace')->nullable();
            $table->date('pexpiry')->nullable();
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
        Schema::dropIfExists('p_d_f_generators');
    }
}
