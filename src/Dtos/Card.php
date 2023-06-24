<?php

namespace Ittech\Payme\Dtos;

class Card extends BaseDto
{
    public function __construct(
        public string $number,
        public string $expire,
    )
    {
    }
}
