<?php

namespace Ittech\Payme\Requests\Receipt;

use Ittech\Payme\Requests\BaseRequest;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class SetFiscalDataRequest extends BaseRequest
{
    public function __construct(
        public string         $id,
        #[DataCollectionOf(FiscalData::class)]
        public DataCollection $fiscal_data,
    )
    {
    }
}
