<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01/08/2018
 * Time: 09:46
 */

namespace ScyLabs\ApimoBundle;


use ScyLabs\ApimoBundle\DependencyInjection\ScyLabsApimoExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ScyLabsApimoBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ScyLabsApimoExtension();
    }
}