<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/3/2018
 * Time: 8:36 AM
 */

namespace MongooseIm\Facades;


use MongooseIm\Commands\Contracts\MongooseImCommand;
use MongooseIm\MongooseIm;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed execute(MongooseImCommand $command)
 *
 * Class MongooseImFacade
 * @package MongooseIm\Facades
 */
class MongooseImFacade extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return MongooseIm::class;
    }
}
