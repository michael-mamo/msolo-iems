<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactAdminMesssagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_admin_messsages', function (Blueprint $table) {
            $table->id();
            $table->integer('senderid');
            $table->string('senderrole');
            $table->integer('recieverid');
            $table->string('recieverrole');
            $table->string('message', 2000)->nullable();
            $table->string('attachment', 2000)->nullable();
            $table->integer('replyonid')->nullable();
            $table->integer('isseen')->default(0);
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
        Schema::dropIfExists('contact_admin_messsages');
    }
}
