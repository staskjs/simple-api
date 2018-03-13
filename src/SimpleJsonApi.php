<?php namespace Staskjs\SimpleApi;

use GuzzleHttp\Exception\RequestException;

class SimpleJsonApi extends SimpleApi {

    protected function processResponse($data) {
        return json_decode($data, true);
    }

    protected function makeRequest($method, $url, $query, $body, $files = [], $requestParams = []) {
        $params = [
            'query' => $query,
            'json' => $body,
            'headers' => $this->headers,
        ] + $this->defaultRequestParams + $requestParams;
        return $this->client->request($method, $url, $params);
    }
}
