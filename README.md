# This is my package laravel-payme-client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ittech/laravel-payme.svg?style=flat-square)](https://packagist.org/packages/ittech/laravel-payme)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ittech/laravel-payme/run-tests?label=tests)](https://github.com/ittech/laravel-payme/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ittech/laravel-payme/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/ittech/laravel-payme/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ittech/laravel-payme.svg?style=flat-square)](https://packagist.org/packages/ittech/laravel-payme)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-payme.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-payme)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require ittech/laravel-payme
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-payme-config"
```

This is the contents of the published config file:

```php
return [
    'proxy_url' => env('PAYME_PROXY_URL', ''),
    'proxy_proto' => env('PAYME_PROXY_PROTO', ''),
    'proxy_host' => env('PAYME_PROXY_HOST', ''),
    'proxy_port' => env('PAYME_PROXY_PORT', ''),
    'base_url' => env('PAYME_BASE_URL', 'https://checkout.paycom.uz'),
    'merchant_id' => env('PAYME_MERCHANT_ID', ''),
    'key' => env('PAYME_KEY', ''),
];
```

## Usage

```php
$payme = new Ittech\Payme();
echo $payme->echoPhrase('Hello, Ittech!');
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sodiqmirzo Sattorov](https://github.com/Sodiqmirzo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
