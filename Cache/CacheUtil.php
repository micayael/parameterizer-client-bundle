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

    public function get($dominio, $codigo=null)
    {
        $parametros = $this->cache->fetch('cache')['parametros'];

        if(!$codigo){

            if(isset($parametros[$dominio])){
                return $parametros[$dominio];
            }

            return null;
        }

        if(isset($parametros[$dominio]) && isset($parametros[$dominio][$codigo])){
            return $parametros[$dominio][$codigo];
        }

        return null;
    }

    public function getAll()
    {
        return $this->cache->fetch('cache')['parametros'];
    }
}
