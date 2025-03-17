<?php

namespace Rmairena\TransactionHttp\Models;
use Illuminate\Database\Eloquent\Model;

class TransactionTraceLog extends Model {
    protected $fillable = ['log', 'transaction_trace_id'];

    public function getTable()
    {
        return config('table-definition.TransactionTraceLog');
    }

}