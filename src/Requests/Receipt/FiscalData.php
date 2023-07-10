<?php

namespace Ittech\Payme\Requests\Receipt;

use Ittech\Payme\Requests\BaseRequest;

class FiscalData extends BaseRequest
{
    public function __construct(
        public int    $status_code,
        public string $message,
        public string $terminal_id,
        public string $receipt_id,
        public string $date,
        public string $fiscal_sign,
        public string $qr_code_url,
    )
    {
    }
}
