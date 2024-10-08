<?php
class ActiveCampaignAPI {
    private $api_key;
    private $api_url;

    public function __construct($api_url, $api_key) {
        $this->api_url = $api_url;
        $this->api_key = $api_key;
    }

    public function create_contact($contact_data) {
        $url = $this->api_url . '/api/3/contacts';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Api-Token: ' . $this->api_key]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($contact_data));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}