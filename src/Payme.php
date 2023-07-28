<?php

namespace Ittech\Payme;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Ittech\Payme\Exceptions\PaymeException;
use Ittech\Payme\Services\CardService;
use Ittech\Payme\Services\ReceiptService;
use Throwable;

class Payme
{
    private PendingRequest $client;

    private ?string $request_id = null;

    public function __construct()
    {
        try {
            $config = config('payme');
            $proxy_url = $this->config['proxy_url'] ?? (($config['proxy_proto'] ?? '') . '://' . ($config['proxy_host'] ?? '') . ':' . ($config['proxy_port'] ?? '')) ?? '';
            $options = is_string($proxy_url) && str_contains($proxy_url, '://') && strlen($proxy_url) > 12 ? ['proxy' => $proxy_url] : [];

            $this->client = Http::log()->baseUrl($config['base_url'])
                ->withHeaders($this->request_id ? ['request_id' => $this->request_id] : [])
                ->withHeaders(['Request-From' => $config['request_from'] ?? 'Merchant Gateway'])
                ->asJson()->withOptions($options);

        } catch (Throwable) {
            throw new PaymeException('Payme config not found', -1024);
        }
    }

    public function withRequestId(string $request_id): self
    {
        $this->request_id = $request_id;

        return $this;
    }

    public function card(): CardService
    {
        $client = $this->client->withHeaders([
            'X-Auth' => config('payme.merchant_id'),
        ]);
        return new CardService($client);
    }

    public function receipt(): ReceiptService
    {
        $merchant_id = config('payme.merchant_id');
        $key = config('payme.key');

        $headers = $this->client->getOptions()['headers'];

        $client = $this->client;

        if (!isset($headers['X-Auth'])) {
            $client = $this->client->withHeaders([
                'X-Auth' => $merchant_id . ':' . $key,
            ]);
        }

        return new ReceiptService($client);
    }
}
