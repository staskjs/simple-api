<?php namespace Staskjs\SimpleApi;

use GuzzleHttp\Exception\RequestException;

class SimpleJsonApi extends SimpleApi {

    protected function processResponse($data) {
        return json_decode($data, true);
    }
}
