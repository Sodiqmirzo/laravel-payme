<?php

namespace Ittech\Payme\Responses\Receipt;

use Ittech\Payme\Responses\BaseResponse;

class PayResponse extends BaseResponse
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
        public int     $processing_id,
        public array   $card,
        public array   $payer,
        public array $account,
        public ?array  $meta,
        public ?array  $creator,
        public ?array  $category,
        public ?array  $error,
        public ?string $description,
        public ?array  $detail,

    )
    {
    }

    public function isOk(): bool
    {
        return $this->state === 4 && $this->_id !== null;
    }
}
