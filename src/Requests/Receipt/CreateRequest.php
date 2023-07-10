<?php

namespace Ittech\Payme\Requests\Receipt;

use Ittech\Payme\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function __construct(
        public int    $amount,
        public array  $account,
        public array  $detail,
        public array  $items,
        public string $description = '',
    )
    {
    }
}
