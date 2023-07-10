<?php

namespace Ittech\Payme\Responses\Receipt;

use Ittech\Payme\Responses\BaseResponse;

class CheckResponse extends BaseResponse
{
    public function __construct(
        public bool $state,
    )
    {
    }

    public function isOk(): bool
    {
        return $this->state !== null;
    }
}
