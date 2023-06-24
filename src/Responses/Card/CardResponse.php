<?php

namespace Ittech\Payme\Responses\Card;

use Ittech\Payme\Responses\BaseResponse;

class CardResponse extends BaseResponse
{

    public function __construct(
        public string $number,
        public string $expire,
        public string $token,
        public bool   $recurrent,
        public bool   $verify,
    )
    {
    }

    public function isOk(): bool
    {
        return $this->token !== null && $this->recurrent && $this->verify;
    }
}
