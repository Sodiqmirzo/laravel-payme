<?php

namespace Ittech\Payme\Responses\Receipt;

use Ittech\Payme\Responses\BaseResponse;

class SendResponse extends BaseResponse
{
    public function __construct(
        public bool $success,
    )
    {
    }

    public function isOk(): bool
    {
        return $this->success;
    }
}
