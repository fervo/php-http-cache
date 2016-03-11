<?php

namespace PhpHttpCache\TaggingAdapter\ObjectIdGenerator;

interface ObjectIdGeneratorInterface
{
    public function normalizeUrlToObjectId($url);

    public function objectIdToUrl($url);
}
