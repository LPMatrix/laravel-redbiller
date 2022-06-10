# Laravel Redbiller Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/LPMatrix/laravel-redbiller.svg?style=flat-square)](https://packagist.org/packages/LPMatrix/laravel-redbiller)
[![Total Downloads](https://img.shields.io/packagist/dt/LPMatrix/laravel-redbiller.svg?style=flat-square)](https://packagist.org/packages/LPMatrix/laravel-redbiller)
![GitHub Actions](https://github.com/LPMatrix/laravel-redbiller/actions/workflows/main.yml/badge.svg)

A Laravel Package for working with Redbiller seamlessly

## Installation

You can install the package via composer:

```bash
composer require lpmatrix/laravel-redbiller
```

## Configuration

You can publish the configuration file using this command:

```bash
php artisan LPMatrix:publish --provider="LPMatrix\Redbiller\RedbillerServiceProvider"
```

A configuration-file named `redbiller.php` with some sensible defaults will be placed in your `config` directory:

```php
<?php

return [

    /**
     * Secret Key From Redbiller Dashboard
     *
     */
    'secretKey' => getenv('REDBILLER_SECRET_KEY');

    'paymentUrl' => getenv('REDBILLER_URL');

];
```

### Testing

```bash
composer test
```

## Functionalities

### BANK TRANSFER
#### initiateTransaction
#### retryTransaction
#### suggestBanks
#### getTransactions
#### getRetriedTrail
#### verifyTransaction

### PAYMENT SUB-ACCOUNT
### ONE-TIME PAYMENT SUB-ACCOUNT
### USSD PAYMENTS
#### createUSSDCode
#### supportedUSSDBanks
#### verifyUSSDTransaction
#### getUSSDTransactions

### POINT OF SALE
### CARDLESS WITHDRAWAL
### MOBILE AIRTIME
### MOBILE AIRTIME PIN GENERATION
### MOBILE DATA
### WIFI INTERNET
### CABLE TV
### ELECTRICITY
### BETTING
### KNOW YOUR CUSTOMER
### BANK SETTLEMENT
### ONE-TIME PASSWORD
### MISCELLANEOUS

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

-   [Sanusi Mubaraq](https://github.com/LPMatrix)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
