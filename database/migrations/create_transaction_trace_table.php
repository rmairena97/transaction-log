<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTrace extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up(){
        Schema::create($this->getTableName("TransactionTrace"), function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->string('step_name');
            $table->longText("payload")->nullable();
            $table->longText("client_result")->nullable();
            $table->boolean("step_status")->default(false);
            $table->timestamps();
            //foreign key
            $table->foreign('transaction_id')->references('id')->on($this->getTableName("Transaction"));
        });
     }

     public function getTableName($table) : string {
        return config('table-definition')[$table]['table_name'];
     }
      /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName("TransactionTrace"));
    }
}