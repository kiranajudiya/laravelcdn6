<?php

namespace Vipertecpro\laravelcdn6\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CdnFacadeAccessor.
 *
 * @category Facade Accessor
 *
 * @author  Vipul Walia <vipertecpro@gmail.com>
 */
class CdnFacadeAccessor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CDN';
    }
}
