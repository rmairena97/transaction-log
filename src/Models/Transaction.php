<?php

namespace Rmairena\TransactionHttp\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function getTable()
    {
        return config('table-definition.Transaction');
    }

    public static function initTransaction(string $reference_key, int $service_id) : void {
        
    }


}