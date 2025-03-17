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
        Schema::create($this->getTableName("Transaction"), function(Blueprint $table) {
            $table->id();
            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('thread_id');
            $table->timestamps();

            //foreign key
            $table->foreign('thread_id')->references('id')->on($this->getTableName("Thread"));
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
        Schema::dropIfExists($this->getTableName("Transaction"));
    }
};