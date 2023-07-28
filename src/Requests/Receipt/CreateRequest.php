<?php

namespace Ittech\Payme\Requests\Receipt;

use Ittech\Payme\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function __construct(
        public int    $amount,
        public ?array  $account = null,
        public ?array  $detail = null,
        public ?array  $items = null,
        public string $description = '',
    )
    {
    }
}
