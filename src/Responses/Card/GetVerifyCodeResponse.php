<?php

namespace Ittech\Payme\Responses\Card;

use Ittech\Payme\Responses\BaseResponse;

class GetVerifyCodeResponse extends BaseResponse
{
    public function __construct(
        public bool   $sent,
        public string $phone,
        public int    $wait
    )
    {
    }

    public function isOk(): bool
    {
        return $this->sent;
    }
}
