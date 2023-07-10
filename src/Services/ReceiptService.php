<?php

namespace Ittech\Payme\Services;

use Illuminate\Http\Client\RequestException;
use Ittech\Payme\Requests\Receipt\CreateRequest;
use Ittech\Payme\Requests\Receipt\SetFiscalDataRequest;
use Ittech\Payme\Responses\Receipt\CancelResponse;
use Ittech\Payme\Responses\Receipt\CheckResponse;
use Ittech\Payme\Responses\Receipt\CreateResponse;
use Ittech\Payme\Responses\Receipt\GetResponse;
use Ittech\Payme\Responses\Receipt\PayResponse;
use Ittech\Payme\Responses\Receipt\SendResponse;

class ReceiptService extends BaseService
{
    /**
     * @throws RequestException
     */
    public function create(CreateRequest $dto): CreateResponse
    {
        $response = $this->sendRequest('cards.create', $dto->toArray());
        return CreateResponse::from(['receipt' => $response]);
    }

    /**
     * @throws RequestException
     */
    public function pay(string $id, string $token, array $payer = []): PayResponse
    {
        $response = $this->sendRequest('receipts.pay', compact('id', 'token', 'payer'));
        return PayResponse::from(['receipt' => $response]);
    }

    /**
     * @throws RequestException
     */
    public function send(string $id, string $phone): SendResponse
    {
        $request = $this->sendRequest('receipts.send', compact('id', 'phone'));
        return SendResponse::from($request);
    }

    /**
     * @throws RequestException
     */
    public function cancel(string $id): CancelResponse
    {
        $request = $this->sendRequest('receipts.cancel', compact('id'));
        return CancelResponse::from(['receipt' => $request]);
    }

    /**
     * @throws RequestException
     */
    public function check(string $id): CheckResponse
    {
        $request = $this->sendRequest('receipts.check', compact('id'));
        return CheckResponse::from($request);
    }

    /**
     * @throws RequestException
     */
    public function get(string $id): GetResponse
    {
        $request = $this->sendRequest('receipts.get', compact('id'));
        return GetResponse::from($request);
    }

    public function getAll()
    {
        //TODO: will be implemented
    }

    /**
     * @throws RequestException
     */
    public function setFiscalData(SetFiscalDataRequest $dto): SendResponse
    {
        $response = $this->sendRequest('receipts.set_fiscal_data', $dto->toArray());
        return SendResponse::from($response);
    }
}
