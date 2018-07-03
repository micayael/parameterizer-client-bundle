<?php

namespace Micayael\Parameterizer\ClientBundle\Twig;

use Micayael\Parameterizer\ClientBundle\Cache\CacheUtil;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ParameterizerExtension extends AbstractExtension
{
    protected $cacheUtil;

    public function __construct(CacheUtil $cacheUtil)
    {
        $this->cacheUtil = $cacheUtil;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_params', [$this, 'getParamsFunction']),
            new TwigFunction('get_param', [$this, 'getParamFunction']),
        ];
    }

    public function getParamsFunction($dominio=null)
    {
        if($dominio){
            $ret = $this->cacheUtil->get($dominio);
        }else{
            $ret = $this->cacheUtil->getAll();
        }

        return $ret;
    }

    public function getParamFunction($dominio, $codigo)
    {;
        $ret = $this->cacheUtil->get($dominio, $codigo);

        return $ret;
    }
}