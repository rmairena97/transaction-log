<?php

namespace Rmairena\TransactionHttp\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['completed', 'thread_id'];

    public function getTable()
    {
        return config('table-definition.Transaction')['table_name'];
    }

    protected static function booted() {
        static::updating(function( $transaction ) {
           if ( $transaction->completed) {
              Thread::where('id', $transaction->thread_id)->update([
                'active' => true
              ]);
           } 
        });
    }
    

}