<?php

namespace PhpHttpCache\Common\Exception;

/**
 * The attempted action failed because something is wrong with the server.
 * You may attempt the same action again at a later time (informed by the
 * getRetryDelay method), and it MAY succeed.
 *
 * Examples include the client being unable to contact the cache server,
 * the cache server experiencing too heavy load to respond to requests.
 */
class ServerException extends \RuntimeException implements HttpCacheExceptionInterface
{
    private $retryDelay;

    public function setRetryDelay($retryDelay)
    {
        $this->retryDelay = $retryDelay;
    }

    public function getRetryDelay()
    {
        return $this->retryDelay;
    }
}
