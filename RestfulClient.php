<?php

namespace kfreiman\restful;

use GuzzleHttp\Client;
// use yii\base\Component;

class RestfulClient extends Client
{
    public $methods = [
        'get',
        'head',
        'put',
        'post',
        'patch',
        'delete',
        'getAsync',
        'headAsync',
        'putAsync',
        'postAsync',
        'patchAsync',
        'deleteAsync',
    ];

    public function __call($method, $args)
    {
        if (in_array($method, $this->methods)) {
            if (count($args) < 1) {
                throw new \InvalidArgumentException('Magic request methods require a URI and optional params and options array');
            }

            $uriParams = isset($args[1]) ? $args[1] : [];
            $uri = $this->buildUriWithParams($args[0], $uriParams);
            $opts = isset($args[2]) ? $args[2] : [];

            return substr($method, -5) === 'Async'
                ? $this->requestAsync(substr($method, 0, -5), $uri, $opts)
                : $this->request($method, $uri, $opts);
        }
    }


    public function buildUriWithParams($uriWithTokens, $uriParams)
    {
        foreach ($uriParams as $key => $value) {
            $uriWithTokens = str_replace('{' . $key . '}', $value, $uriWithTokens);
        }
        return $uriWithTokens;
    }

}

