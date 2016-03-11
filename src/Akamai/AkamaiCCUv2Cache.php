<?php

namespace PhpHttpCache\Akamai;

use Akamai\Open\EdgeGrid\Client;
use Akamai\Open\EdgeGrid\Exception as EdgeGridException;
use GuzzleHttp\Exception\ClientException as GuzzleException;
use PhpHttpCache\Common\Exception\ClientException;
use PhpHttpCache\Common\Exception\ServerException;
use PhpHttpCache\Common\Interfaces\InvalidatebleHttpCacheInterface;
use PhpHttpCache\Common\Interfaces\PurgableHttpCacheInterface;

/**
* Documented at https://developer.akamai.com/api/purge/ccu/overview.html
*/
class AkamaiCCUv2Cache implements InvalidatebleHttpCacheInterface, PurgableHttpCacheInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function invalidate(array $urls)
    {
        $this->perform("invalidate", $urls);
    }

    public function purge(array $urls)
    {
        $this->perform("purge", $urls);
    }

    protected function perform($action, $urls)
    {
        $purge_body = [
            "action" => $action,
            "objects" => [
                $urls
            ],
            "type" => "arl",
        ];

        try {
            $response = $this->client->post('/ccu/v2/queues/default', [
                'body' => json_encode($purge_body),
                'headers' => ['Content-Type' => 'application/json']
            ]);
        } catch (EdgeGridException $e) {
            throw new ClientException($e->getMessage(), 0, $e);
        } catch (GuzzleException $e) {
            throw new ServerException($e->getMessage(), 0, $e);
        }

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new ClientException((string)$response->getBody());
        } else if ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new ServerException((string)$response->getBody());
        } else if (!($response->getStatusCode() >= 200 && $response->getStatusCode() < 300)) {
            throw new ClientException("Unknown error");
        }
    }
}
