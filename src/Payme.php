<?php

namespace Ittech\Payme;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Ittech\Payme\Exceptions\PaymeException;
use Ittech\Payme\Services\CardService;
use Throwable;

class Payme
{
    private PendingRequest $client;

    public function __construct()
    {
        try {
            $config = config('payme');
            $proxy_url = $this->config['proxy_url'] ?? (($config['proxy_proto'] ?? '') . '://' . ($config['proxy_host'] ?? '') . ':' . ($config['proxy_port'] ?? '')) ?? '';
            $options = is_string($proxy_url) && str_contains($proxy_url, '://') && strlen($proxy_url) > 12 ? ['proxy' => $proxy_url] : [];

            $this->client = Http::log()->baseUrl($config['base_url'])->asJson()->withOptions($options);

        } catch (Throwable) {
            throw new PaymeException('Payme config not found', -1024);
        }
    }

    public function card(): CardService
    {
        $client = $this->client->withHeaders([
            'X-Auth' => config('payme.merchant_id'),
        ]);
        return new CardService($client);
    }
}
