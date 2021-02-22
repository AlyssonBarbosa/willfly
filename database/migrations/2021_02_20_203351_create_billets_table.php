<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf_cnpj');
            $table->foreignId('address_id');
            $table->dateTimeTz('expiration');
            $table->double('fees')->nullable();
            $table->decimal('price', 9, 2);
            $table->string('instructions')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();           
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
        Schema::dropIfExists('billets');
    }
}
