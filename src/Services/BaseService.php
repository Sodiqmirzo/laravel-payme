<?php

namespace Ittech\Payme\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Str;
use Ittech\Payme\Exceptions\PaymeException;

abstract class BaseService
{
    private string $_id = '';

    public function __construct(private PendingRequest $client)
    {
    }

    public function getLastRequestId(): string
    {
        return $this->_id;
    }

    protected function baseUrl($url): static
    {
        $this->client = $this->client->baseUrl($url);

        return $this;
    }

    /**
     * @param string $method
     * @param array $params
     * @return array|mixed
     * @throws RequestException
     */
    protected function sendRequest(string $method, array $params)
    {
        $this->_id = Str::ulid()->toBase58();
        $response = $this->client->post('', ['jsonrpc' => '2.0', 'method' => $method, 'id' => $this->_id, 'params' => $params])
            ->throw(fn($r, $e) => self::catchHttpRequestError($e, $r));
        $json = $response->json('result');

        if ($json === null) {
            $json = $response->json('error');
            $message = $json['message'] ?? 'Wrong response';
            $lKey = 'payme.';
            $message = ltrim(__($lKey . $message), $lKey);

            $code = $json['code'] ?? -2048;
            throw new PaymeException($message, $code);
        }

        if (isset($json['error'])) {
            return match ($json['error']['code'] ?? -99999) {
                /*-208 => throw new PaymentNotFoundException($json['error']['message'] ?? 'Transaction not found', $json['error']['code']),*/
                default => throw new PaymeException($json['error']['message'] ?? 'Unknown error', $json['error']['code'])
            };
        }

        return $json;
    }

    /**
     * @param $e
     * @param null $r
     * @throws PaymeException
     */
    private static function catchHttpRequestError($e, $r = null)
    {
        throw new PaymeException($e->getMessage(), $e->getCode());
    }

    protected function checkZero($code): bool
    {
        return $code === 0 || $code === '0';
    }
}
