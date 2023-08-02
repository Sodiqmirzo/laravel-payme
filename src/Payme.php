<?php

namespace Ittech\Payme;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Ittech\Payme\Exceptions\PaymeException;
use Ittech\Payme\Services\CardService;
use Ittech\Payme\Services\ReceiptService;
use Throwable;
use Uzbek\LaravelSvgate\Exceptions\PaymentNotFoundException;
use Uzbek\LaravelSvgate\Exceptions\SvgateException;

class Payme
{
    private PendingRequest $client;

    public function __construct()
    {
        try {
            $config = config('payme');
            $proxy_url = $this->config['proxy_url'] ?? (($config['proxy_proto'] ?? '') . '://' . ($config['proxy_host'] ?? '') . ':' . ($config['proxy_port'] ?? '')) ?? '';
            $options = is_string($proxy_url) && str_contains($proxy_url, '://') && strlen($proxy_url) > 12 ? ['proxy' => $proxy_url] : [];

            $this->client = Http::log()->baseUrl($config['base_url'])
                ->withHeaders(['x-requested-with' => $config['request_from'] ?? 'Merchant Gateway'])
                ->asJson()->withOptions($options);

        } catch (Throwable) {
            throw new PaymeException('Payme config not found', -1024);
        }
    }

    public function card(): CardService
    {
        $merchant_id = config('payme.merchant_id');

        return new CardService($this->client->xAuthHeader($merchant_id));
    }

    public function receipt(): ReceiptService
    {
        $merchant_id = config('payme.merchant_id');
        $key = config('payme.key');

        return new ReceiptService($this->client->xAuthHeader($merchant_id . ':' . $key));
    }
}
