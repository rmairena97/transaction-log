<?php

namespace Rmairena\TransactionHttp\Models;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model {
    protected $filable = [];

    public function getTable()
    {
        return config('table-definition.TransactionType');
    }

}