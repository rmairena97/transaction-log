<?php

namespace Rmairena\TransactionHttp\Models;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model {
    protected $fillable = ['active', 'reference_key', 'service_identifier'];

    public function getTable()
    {
        return config('table-definition.Thread')['table_name'];
    }

    public static function getModelRow($reference_key, $service_identifier) {
        return self::query()->where('reference_key', $reference_key)->where('service_identifier', $service_identifier)->first();
    }

}