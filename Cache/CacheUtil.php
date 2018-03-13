<?php

namespace Micayael\Parameterizer\ClientBundle\Cache;

use Doctrine\Common\Cache\FilesystemCache;

class CacheUtil
{
    private $cache;
    private $data;
    private $cacheDir;

    public function __construct($cacheDir)
    {
        $this->data = array();

        $this->cacheDir = $cacheDir;

        $this->cache = new FilesystemCache($cacheDir);
    }

    public function save()
    {
        $this->cache->save('cache', $this->data);
    }

    public function add($key, $data)
    {
        $this->data[$key] = $data;
    }

    public function get($key)
    {
        return $this->cache->fetch('cache')[$key];
    }

    public function getAll()
    {
        return $this->cache->fetch('cache');
    }
}
