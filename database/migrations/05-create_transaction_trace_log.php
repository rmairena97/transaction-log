<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up(){
        Schema::create($this->getTableName("TransactionTraceLog"), function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_trace_id');
            $table->text('log');
            $table->timestamps();

            //foreign key
            $table->foreign('transaction_trace_id')->references('id')->on($this->getTableName("TransactionTrace"));
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
        Schema::dropIfExists($this->getTableName("TransactionTraceLog"));
    }
};