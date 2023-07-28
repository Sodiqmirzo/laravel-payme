<?php

namespace Ittech\Payme;

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
}
