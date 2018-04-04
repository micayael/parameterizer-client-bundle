<?php

namespace Micayael\Parameterizer\ClientBundle\Cache;

use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmer;

class Warmer extends CacheWarmer
{
    private $cacheUtil;
    private $configs;

    public function __construct(CacheUtil $cacheUtil, array $configs)
    {
        $this->cacheUtil = $cacheUtil;
        $this->configs = $configs;
    }

    public function warmUp($cacheDir)
    {
        $client = new Client();

        $uri = $this->configs['host'].$this->configs['uri'];

        $response = $client->request('GET', $uri, [
            'auth' => [$this->configs['username'], $this->configs['username']],
        ]);

        $parametros = json_decode($response->getBody(), true);

        $this->cacheUtil->add('parametros', $parametros);

        $this->cacheUtil->save();
    }

    public function isOptional()
    {
        return false;
    }
}
