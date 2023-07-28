<?php

namespace Ittech\Payme\Responses\Receipt;

use Ittech\Payme\Enums\ReceiptState;
use Ittech\Payme\Responses\BaseResponse;

class CreateResponse extends BaseResponse
{
    public function __construct(
        public string  $_id,
        public int     $create_time,
        public int     $pay_time,
        public int     $cancel_time,
        public int     $state,
        public int     $type,
        public bool    $external,
        public int     $operation,
        public int     $amount,
        public int     $currency,
        public int     $commission,
        public array   $merchant,
        public array   $meta,
        public ?array  $card,
        public ?array  $creator,
        public ?array  $payer,
        public ?array  $category,
        public ?string $error,
        public ?string $processing_id,
        public string  $description = '',
        public ?array   $detail = [],
        public array   $account = [],
    )
    {
    }

    public function isOk(): bool
    {
        return $this->state === ReceiptState::NEW->value && $this->_id !== null;
    }
}
