<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/3/2018
 * Time: 8:38 AM
 */

namespace MongooseIm\Commands\Contracts;


interface MongooseImCommand
{

    /**
     * @return string
     */
    public function url();

    /**
     * @return array
     */
    public function data();


    /**
     * @return string
     */
    public function method();

    /** @return string */
    public function accept();
}
