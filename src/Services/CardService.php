<?php

namespace Ittech\Payme\Services;

use Ittech\Payme\Dtos\Card;
use Ittech\Payme\Requests\Card\CreateCardRequest;
use Ittech\Payme\Responses\Card\CardResponse;
use Ittech\Payme\Responses\Card\GetVerifyCodeResponse;

class CardService extends BaseService
{
    public function create(CreateCardRequest|string $number, string $expire, bool $save = false): CardResponse
    {
        if (!$number instanceof CreateCardRequest) {
            $number = new CreateCardRequest(new Card($number, $expire), $save);
        }

        $response = $this->sendRequest('cards.create', $number->toArray());

        return CardResponse::from($response['card']);
    }

    public function verifyCode(string $token): GetVerifyCodeResponse
    {
        $response = $this->sendRequest('cards.get_verify_code', compact('token'));

        return GetVerifyCodeResponse::from($response);
    }

    public function verify(string $token, string $code): CardResponse
    {
        $response = $this->sendRequest('cards.verify', compact('token', 'code'));

        return CardResponse::from($response['card']);
    }

    public function check(string $token): CardResponse
    {
        $response = $this->sendRequest('cards.check', compact('token'));

        return CardResponse::from($response);
    }
}
