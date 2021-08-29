<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('phone', 20)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('zip_code', 9)->nullable();
            $table->string('addr_number', 10)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('complement', 50)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('img_name')->nullable();
            $table->string('img_path')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
