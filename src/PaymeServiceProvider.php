<?php

namespace Ittech\Payme;

use Illuminate\Http\Client\PendingRequest;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PaymeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('payme')->hasConfigFile('payme');

        $this->app->singleton(Payme::class, function () {
            return new Payme();
        });
    }

    public function bootingPackage(): void
    {
        PendingRequest::macro('xAuthHeader', function (string $method) {
            $this->options['headers']['X-Auth'] = $method;
            return $this;
        });
    }
}
