<?php

namespace Ittech\Payme\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ittech\Payme\Payme
 */
class Payme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ittech\Payme\Payme::class;
    }
}
