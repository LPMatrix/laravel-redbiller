# Laravel Redbiller Package

> A Laravel Package for working with Redbiller seamlessly.


[![Latest Version on Packagist](https://img.shields.io/packagist/v/LPMatrix/laravel-redbiller.svg?style=flat-square)](https://packagist.org/packages/LPMatrix/laravel-redbiller)
[![Total Downloads](https://img.shields.io/packagist/dt/LPMatrix/laravel-redbiller.svg?style=flat-square)](https://packagist.org/packages/LPMatrix/laravel-redbiller)


# Installation

You can install the package via composer:

```bash
composer require lpmatrix/laravel-redbiller
```

# Configuration

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

# Testing

```bash
composer test
```

# Functionalities

## BANK TRANSFER
### Initiate Transaction
Send money to any Nigerian bank account.
```php
$data = [];
Redbiller::initiateTransaction($data);
```
### Retry Transaction
Retry a Cancelled transaction.

> Please note that for your safety, transactions can only be retried once within 24 hours of initiation of which its status will then be updated to Retried to prevent you from retrying them again.
```php
$data = [];
Redbiller::retryTransaction($data);
```
### Suggest banks
This resource suggests banks for the recipients' bank account number where they're likely to have an account.
```php
Redbiller::suggestBanks($account_no);
```
### Get transactions
See all transfers you've done; filter by status, bank code, and more.
```php
```
### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```
### Verify transaction
Confirm the status of the transaction before giving value to your customers.
```php
```

### Add to watchlist
Add customers who are under surveillance to Watchlist to control the amount of money that they can withdraw to their bank accounts.
> Kindly save the reference returned in the response on the customer's profile, as it would be used to carry out other activities on the profile.
```php
```

### List watchlist
See all customers you've added to Watchlist; filter by reference, and more.
```php
```

### Initiate watchlist transaction
Send money to customers on Watchlist.
> We recommend that you only use this API if your customers has already been Watchlisted.
```php
```

### List watchlist transaction
See all transfers you've done; filter by status, bank code, and more.
```php
```

### Update watchlist transaction
Update Watchlist to control the amount of money that your customers can withdraw to their bank accounts.
```php
```

### Remove from watchlist
Customers who are removed will no longer be controlled by Watchlist.
```php
```

## PAYMENT SUB-ACCOUNT
### Create account
We strongly advice that you pass the real names of your customers gotten from the BVN verification endpoint.
> You'll need to install the sub-account on your account corresponding to the Payment Sub-Account you wish to create.
```php
```

### Callback response
You'll need to setup a PSA callback URL on your account.
> Send a request to this endpoint to get a sample response; query your database for the user ID using the sub_account.reference returned and credit their wallet with either the amount or settlement returned. No real money is involved in this transaction.
```php
```

### Get accounts
See all accounts; filter by reference, account number, and more.
```php
```

### Get balance
See all balances in an account.
```php
```

### Get payments
See all payments you've received; filter by reference, account number, and more.
```php
```

### Get statement
See all credits and debits on a sub-account; filter by type, page, and more.
```php
```

### Request debit
Withdraw funds from your customers' sub-accounts.
> Please call the resolve debit endpoint whenever a debit request pends.
```php
```

### Verify payment
We strongly recommend that you verify payments before giving value to your customers.
```php
```

### Resolve payment
Resolve a pending payment.
```php
```
### Enable auto settlement
When enabled, payments are instantly settled to your account when your customers pay you.
> This feature is only available to Kuda PSAs
```php
```

### Disable auto settlement
When disabled, you'll need to call Request debit endpoint to get settled in part or in whole
> This feature is only available to Kuda PSAs
```php
```

### Blacklist account
This feature protects you from fraudulent customers.
> Payments made into blacklisted accounts will be indicated as "blacklisted": "true" in the responses. Please, do not give value until you have verified the legitimacy of the transactions.
```php
```

### Whitelist account
This feature helps you whitelist a once-blacklisted PSA.
```php
```

## ONE-TIME PAYMENT SUB-ACCOUNT
We strongly advice that you pass the real names of your customers gotten from the BVN verification endpoint.
### Create account

```php
```
### Verify payment
```php
```
### Get payments
See all payments you've received; filter by reference, account number, and more.
```php
```

## USSD PAYMENTS
### Create USSD Code
We strongly advice that you pass the real names of your customers gotten from the BVN verification endpoint.
```php
```
### Supported USSD Banks
Get all supported banks.
```php
```
### Verify USSD Transaction
```php
```
### Get USSD Transactions
See all payments you've received; filter by reference, and more.
```php
```

## POINT OF SALE
### Create order
Purchase POS devices for your customers and have them delivered anywhere in Nigeria.
> For multiple delivery addresses, create multiple objects in the order.
```php
```

### Callback response
You'll need to setup a POS callback URL on your account.
> Send a POST request to this endpoint to get a sample response; query your database for the user ID using the terminal_id returned and credit their wallet with either the amount or settlement returned. No real money is involved in this transaction.
```php
```

### Get order status
Confirm the delivery status of your order.
```php
```

### Get POS types
Get the different POS device types available for sale. Use the type_id upon purchase.
```php
```

### Get POS devices
See all POS devices; filter by type ID, terminal ID, and more.
```php
```

### Get payments
See all payments; filter by type ID, terminal ID, and more.
```php
```

### Update POS
Set up a name and phone number of your POS devices to conveniently top-up your device via the API.
```php
```

### Verify payment
Confirm the status of the payment before giving value to your customers.
```php
```

## CARDLESS WITHDRAWAL
### Create Paycode
Withdraw money from supported ATMs and POSs without the use of physical ATM cards.
> Your customer will be required to use the code returned upon creation and the four digit PIN they set to authorize the transaction.
```php
```

### Get supported banks
See all supported banks.
```php
```

### Get Paycodes
See all Paycodes you've created; filter by status, type, and more.
```php
```

### Verify Paycode status
Find out if a Paycode has been cashed-out.
```php
```

### Cancel Paycode
This action is irreversible.
> Please note that Paycodes can only be cancelled when expired.
```php
```

## MOBILE AIRTIME
### Purchase airtime
Send airtime to your customers in their preferred mobile network.
```php
```

### Retry purchase
Retry a Cancelled transaction.
```php
```

### Verify purchase
Confirm the status of a transaction.
```php
```

### Get purchases
Get all transactions; filter by status, phone number and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## MOBILE AIRTIME PIN GENERATION
### Purchase airtime PIN
Purchase airtime PINs in your customers' preferred mobile networks.
> Use the corresponding network to load a PIN.
```php
```

### Retry purchase
Retry a Cancelled transaction.
> Please note that for your safety, transactions can only be retried once within 24 hours of initiation of which its status will then be updated to Retried to prevent you from retrying them again.
```php
```

### Verify purchase
Confirm the status of a transaction.
```php
```

### Check status
Find out if a PIN has been used.
```php
```

### Get purchases
Get all transactions; filter by status, phone number and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## MOBILE DATA
### Purchase plan
Send data to your customers in their preferred mobile network.
```php
```

### Retry purchase
Retry a Cancelled transaction.
```php
```

### Get plans
See data plans for available mobile networks.
```php
```

### Verify purchase
Verify the status of a transaction.
```php
```

### Get purchases
Get all transactions; filter by status, phone number and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## WIFI INTERNET
### Purchase plan
Send data to your customers in their preferred Internet network.
```php
```

### Retry purchase
Retry a Cancelled transaction.
```php
```

### Get plans
See Internet plans for available networks.
```php
```

### Verify device number
Verify your customers' device number before transacting.
```php
```

### Verify purchase
Verify the status of a transaction.
```php
```

### Get purchases
Get all transactions; filter by status, device number and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## CABLE TV
### Purchase plan
Subscribe your customers' preferred cable network.

### Retry purchase
Retry a Cancelled transaction.
```php
```

### Get plans
### Verify smartcard number
Verify your customers' smart card number before transacting.
```php
```

### Verify purchase
Verify the status of a transaction.
```php
```

### Get purchases
Get all transactions; filter by status, device number and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## ELECTRICITY
### Purchase token
Purchase tokens for your customers from their preferred electricity biller.
```php
```

### Retry purchase
Retry a Cancelled transaction.
```php
```

### Verify meter number
Verify your customers' meter number before transacting.
```php
```

### Verify purchase
Verify the status of a transaction.
```php
```

### Get purchases
Get all transactions; filter by status, device number and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## BETTING
### Credit account
Fund betting accounts of your customers from different providers.
```php
```

### Retry transaction
Retry a Cancelled transaction.
```php
```

### Get providers
Get all supported betting providers.
```php
```

### Verify account
Verify the identity of a betting account.
```php
```

### Verify transaction
Confirm the status of a transaction.
```php
```

### Get transactions
Get all transactions; filter by status, customer ID and more.
```php
```

### Get retried trail
See all instances a cancelled (failed and reversed) transaction was retried.
```php
```

## KNOW YOUR CUSTOMER
### BVN lookup
Get the BVN of your customers with just their account number and bank code.
```php
```

### Verify BVN 1.0
This resource returns the customers' basic details.
```php
```

### Verify BVN 2.0
This resource returns more information about the customer, including their photo.
```php
```

### Verify BVN 3.0
This resource returns more information about the customer, including their photo.
```php
```

### Verify bank account
Verify the recipient bank account number before initiating a bank transfer.
```php
```

### Bank account lookup
Get important information of your customers with just their account number and bank code.
```php
```

### Find bank account
This resource finds and returns your customers' account name, bank code, and more where they have an account.
```php
```

### Verify phone number 1.0
Get the full name and date of birth of your customers.
```php
```

### Verify phone number 2.0
Get the full name and date of birth of your customers.
```php
```

### Verify phone number 3.0
Get the full name, BVN, and date of birth of your customers.
```php
```

### Verify driver's license
Confirm the Driver's License of your customers and know more about them, such as their gender, date of birth, and more.
```php
```

### Verify National ID
Confirm that your customers are Nigerians through their National Identification Number and know more about them, such as their gender, date of birth, and more.
```php
```

### Verify Voter's Card
Confirm the identity of your customers though their Voter's Card.
```php
```

### Verify International Passport
Confirm the identity of your customers though their International Passport.
```php
```

### Verify company registration
Confirm your customers' company registration and know more about them, such as their date of incorporation and more.
```php
```

### Verify Tax ID
Confirm your customers' company Tax Identification Number.
```php
```

### Get bank account tier
Get tier of a bank account.
```php
```

### Validate bank account tier
Validate the bank account tier before initiating a bank transfer.
```php
```

## BANK SETTLEMENT
### Request settlement
Send money to your settlement bank account.
```php
```

### Retry request
Retry a Cancelled transaction.
```php
```

### Get accounts
Transfer money to this bank account to fund your account.
```php
```

### Get settlements
See all settlement you've done; filter by status, account_id, and more.
```php
```

### Verify settlement
Confirm the status of the settlement.
```php
```

## ONE-TIME PASSWORD
### Create OTP
Send customized One-Time Passwords to your customers with our secure DND channel.
```php
```

### Verify OTP
Confirm the validity of an OTP before processing your customers' requests.
```php
```

### Cancel OTP
This action is irreversible and verification will fail.
```php
```

### Get OTPs
See all OTPs you've created; filter by phone_no, reference, and more.
```php
```


## MISCELLANEOUS
### Get bank list
Get all supported banks in different categories. E.g, commercial banks.
```php
```

### Get balance
Know when you're running low on funds and fund your account via any of your sub-accounts.
```php
```

### Get coupon codes
See all coupon codes and their respective supported services enabled on your account.
```php
```

### Verify coupon code
See the services supported by a coupon code.
```php
```
