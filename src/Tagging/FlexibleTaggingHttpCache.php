<?php

namespace Common;

use InvalidArgumentException;
use PhpHttpCache\Tagging\Interfaces\TaggingInvalidatebleHttpCacheInterface;
use PhpHttpCache\Tagging\Interfaces\TaggingPurgableHttpCacheInterface;
use PhpHttpCache\Common\FlexibleHttpCache;

class FlexibleTaggingHttpCache extends FlexibleHttpCache
{
    public function __construct($httpCache)
    {
        if (!$httpCache instanceOf TaggingInvalidatebleHttpCacheInterface && !$httpCache instanceOf TaggingPurgableHttpCacheInterface) {
            throw new InvalidArgumentException(sprintf("HttpCache must implement at least one of the following interfaces: %s, %s", TaggingInvalidatebleHttpCacheInterface::class, TaggingPurgableHttpCacheInterface::class));
        }

        parent::__construct($httpCache);
    }

    public function purgeOrInvalidateTags(array $tags)
    {
        if ($this->httpCache instanceOf TaggingPurgableHttpCacheInterface) {
            $this->purgeTags($tags);
        } else {
            $this->invalidateTags($tags);
        }
    }

    public function invalidateOrPurgeTags(array $tags)
    {
        if ($this->httpCache instanceOf TaggingInvalidatebleHttpCacheInterface) {
            $this->invalidateTags($tags);
        } else {
            $this->purgeTags($tags);
        }
    }
}
