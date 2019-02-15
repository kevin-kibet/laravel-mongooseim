<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kibet
 * Date: 2/15/2019
 * Time: 7:22 PM
 */

namespace MongooseIm\Traits;


/**
 * Trait ConfigAwareCommand
 * @package MongooseIm\Traits
 */
trait ConfigAwareCommand
{
    /**
     * @var
     */
    private $config;

    /**
     * @param $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function getMucDomain()
    {
        return $this->config['muc_domain'];
    }

    public function getMucLightDomain()
    {
        return $this->config['muc_light_domain'];
    }

    public function getDomain()
    {
        return $this->config['domain'];
    }
}
