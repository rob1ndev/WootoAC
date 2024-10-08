<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Laad de configuratie en de benodigde klassen
require __DIR__ . '/../config/config.php';
require 'src/classes/WooCommerceAPI.php';
require 'src/classes/ActiveCampaignAPI.php';

// WooCommerce API ophalen (gebruik de gedefinieerde constanten uit config.php)
$wc_api = new WooCommerceAPI(WC_CONSUMER_KEY, WC_CONSUMER_SECRET);
$orders = $wc_api->get_orders();

// ActiveCampaign API instellen (gebruik de gedefinieerde constanten uit config.php)
$ac_api = new ActiveCampaignAPI(AC_API_URL, AC_API_KEY);

// Voorbeeld: Verstuur klantdata naar ActiveCampaign
foreach ($orders as $order) {
    $contact_data = [
        "contact" => [
            "email" => $order['billing']['email'],
            "firstName" => $order['billing']['first_name'],
            "lastName" => $order['billing']['last_name']
        ]
    ];
    $response = $ac_api->create_contact($contact_data);
    print_r($response);
}
