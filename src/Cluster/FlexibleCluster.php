<?php

namespace PhpHttpCache\Cluster;

use PhpHttpCache\Cluster\Exception\ClusterException;
use PhpHttpCache\Common\Exception\HttpCacheExceptionInterface;
use PhpHttpCache\Common\Interfaces\InvalidatebleHttpCacheInterface;
use PhpHttpCache\Common\Interfaces\FlexibleHttpCacheInterface;
use PhpHttpCache\Common\FlexibleHttpCache;


class FlexibleCluster implements FlexibleHttpCacheInterface
{
    protected $caches;

    public function __construct(array $caches)
    {
        $this->caches = $caches;
    }

    public function purgeOrInvalidate(array $urls)
    {
        $this->attempt(function ($cache) use ($urls) {
            $cache->purgeOrInvalidate($urls);
        });
    }

    public function invalidateOrPurge(array $urls)
    {
        $this->attempt(function ($cache) use ($urls) {
            $cache->invalidateOrPurge($urls);
        });
    }

    protected function attempt(callable $f)
    {
        $clusterException = new ClusterException;

        foreach ($this->caches as $cache) {
            try {
                $f($cache);
            } catch (HttpCacheExceptionInterface $e) {
                $clusterException->addException($e, $cache);
            }
        }

        if ($clusterException->hasExceptions()) {
            throw $clusterException;
        }
    }
}
