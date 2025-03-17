<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder {
    public function run() {
        $catalog = [
            'create',
            'update',
            'delete',
            'show'
        ];

        foreach($catalog as $item){
            DB::table(config('table-definition.TransactionType')['table-name'])->insert([
                'transaction_name' => $item,
                'created_at'=> now(),
                'updated_at'=> now() 
            ]);
        }
    }
}