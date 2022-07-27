<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGemTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gem_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gem_id');
            $table->bigInteger('before')
                    ->unsigned()
                    ->default(0);

            $table->bigInteger('value')
                    ->unsigned();

            $table->string('type')->nullable();
            $table->boolean('sign')->default(true);
            $table->timestamps();

            $table->foreign('gem_id')->references('id')->on('gems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gem_transactions');
    }
}
