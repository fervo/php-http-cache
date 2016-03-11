<?php

namespace PhpHttpCache\Cluster\Exception;

use PhpHttpCache\Common\Exception\HttpCacheExceptionInterface;

/**
* 
*/
class ClusterException extends \RuntimeException
{
    protected $clusterExceptions = [];

    public function addExceptionForCache(HttpCacheExceptionInterface $exception, $cache)
    {
        $this->clusterExceptions[] = ['exception' => $exception, 'cache' => $cache];
    }

    public function getExceptionMap()
    {
        return $this->clusterExceptions;
    }

    public function hasExceptions()
    {
        return count($this->clusterExceptions) > 0;
    }
}
