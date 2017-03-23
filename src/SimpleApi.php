<?php namespace Staskjs\SimpleApi;

use GuzzleHttp\Exception\RequestException;

class SimpleApi {

    private $url;

    private $client;

    private $data;

    private $errors;

    protected $default_query = [];

    protected $headers = [];

    public function __construct($api_url) {

        if (empty($api_url)) {
            throw new \Exception('Api url is empty');
        }

        $this->url = $api_url;

        $this->client = new \GuzzleHttp\Client();
    }

    public function getData() {
        return $this->data;
    }

    public function getErrors($key = null) {
        return empty($key) ? $this->errors : $this->errors[$key];
    }

    protected function request($method, $url, $params = []) {
        $this->data = [];
        $this->errors = [];

        $query = $method == 'GET' ? $params + $this->default_query : $this->default_query;
        $body = $method == 'GET' ? [] : $params;

        try {
            $response = $this->client->request($method, "{$this->url}/$url", [
                'query' => $query,
                'form_params' => $body,
                'headers' => $this->headers,
            ]);
        }
        catch(RequestException $e) {
            if ($e->getResponse()) {
                $this->errors = $this->processResponse($e->getResponse()->getBody());
                return false;
            }
            throw $e;
        }

        $data = $this->processResponse($response->getBody()->getContents());

        $this->data = $data;

        return true;
    }

    protected function processResponse($data) {
        return $data;
    }
}