<?php

namespace PhpHttpCache\TaggingAdapter;

use PhpHttpCache\Tagging\Interfaces\TaggingHttpCacheInterface;
use PhpTagStore\Common\TagStoreInterface;
use PhpHttpCache\TaggingAdapter\ObjectIdGenerator\ObjectIdGeneratorInterface;

class BaseTaggingAdapter implements TaggingHttpCacheInterface
{
    protected $tagStore;
    protected $objectIdGenerator;

    protected function __construct(TagStoreInterface $tagStore, ObjectIdGeneratorInterface $objectIdGenerator)
    {
        $this->tagStore = $tagStore;
        $this->objectIdGenerator = $objectIdGenerator;
    }

    public function tagUrl($url, array $tags)
    {
        $objectId = $this->objectIdGenerator->generateObjectId($url);
        $this->tagStore->tagObject($objectId, $tags);
    }

    protected function performWithTags(callable $f, array $tags)
    {
        $objectIds = $this->tagStore->getObjectsWithTags($tags);
        $urls = array_map([$this->objectIdGenerator, 'objectIdToUrl'], $objectIds);
        $f($urls);
    }
}
