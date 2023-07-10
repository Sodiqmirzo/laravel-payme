<?php

namespace Ittech\Payme\Requests\Card;

use Ittech\Payme\Dtos\Card;
use Ittech\Payme\Requests\BaseRequest;

class CreateCardRequest extends BaseRequest
{
    public function __construct(
        public Card $card,
        public bool $save = false,
    )
    {
    }
}
