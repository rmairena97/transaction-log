<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTypeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up(){
        Schema::create($this->getTableName(), function(Blueprint $table) {
            $table->id();
            $table->string('transaction_name', 150);
            $table->timestamps();
        });
     }

     public function getTableName() : string {
        return config('table-definition.TransactionType')['table_name'];
     }
      /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName());
    }
}