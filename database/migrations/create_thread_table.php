<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up(){
        Schema::create($this->getTableName("Thread"), function(Blueprint $table) {
            $table->id();
            $table->string('reference_key', 150)->index();
            $table->unsignedBigInteger('transaction_type_id');
            $table->string('service_identifier')->index();
            $table->timestamps();

            //foreign key
            $table->foreign('transaction_type_id')->references('id')->on($this->getTableName("Thread"));
        });
     }

     public function getTableName($table) : string {
        return config('table-definition')[$table];
     }

        /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName("Thread"));
    }
}

