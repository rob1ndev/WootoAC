<?php
class WooCommerceAPI {
    private $consumer_key;
    private $consumer_secret;

    public function __construct($consumer_key, $consumer_secret) {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
    }

    public function get_orders() {
        $url = 'https://YOUR_WOOCOMMERCE_SITE/wp-json/wc/v3/orders';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->consumer_key . ':' . $this->consumer_secret);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
