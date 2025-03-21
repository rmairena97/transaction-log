<?php

namespace Rmairena\TransactionHttp\Models;
use Illuminate\Database\Eloquent\Model;

class TransactionTrace extends Model {
    protected $fillable = ['step_name', 'transaction_id', 'payload', 'step_status', 'client_result'];

    public function getTable()
    {
        return config('table-definition.TransactionTrace')['table_name'];
    }

    public static function getLastTrace($transaction_id) {
        return self::query()->where('transaction_id', $transaction_id)->latest()->first();
    }

    public static function getTraceHistory($transaction_id) {
        return self::query()->where('transaction_id', $transaction_id)->get();
    }


}