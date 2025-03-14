<?php

namespace Rmairena\TransactionHttp\Facades;
use Illuminate\Support\Facades\Facade;

class TransactionHttpFacade extends Facade 
{
    public static function getFacadeAccessor() {
        return 'rmairena.transaction.http';
    }
}