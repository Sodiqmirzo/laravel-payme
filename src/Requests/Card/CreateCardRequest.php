<?php

namespace Ittech\Payme\Requests\Card;

use Ittech\Payme\Dtos\Card;
use Ittech\Payme\Requests\BaseRequest;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class CreateCardRequest extends BaseRequest
{
    public function __construct(
//        #[DataCollectionOf(Card::class)]
//        public DataCollection $card,
        public Card           $card,
        public bool           $save = false,
    )
    {
    }
}
