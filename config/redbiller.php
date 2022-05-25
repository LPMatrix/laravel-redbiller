<?php

/*
 * You can place your custom package configuration in here.
 */
return [
      /**
     * Secret Key From Paystack Dashboard
     *
     */
    'secretKey' => getenv('REDBILLER_SECRET_KEY'),

    'paymentUrl' => getenv('REDBILLER_URL')
];
