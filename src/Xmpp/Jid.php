<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kibet
 * Date: 2/15/2019
 * Time: 9:25 AM
 */

namespace MongooseIm\Xmpp;


class Jid
{

    private $username;

    private $host;
    /**
     * @var null
     */
    private $resource;

    private $component = false;

    public function __construct($username, $host, $resource = null, $component = false)
    {
        $this->username = $username;
        $this->host = $host;
        $this->resource = $resource;
        $this->component = $component;
    }

    /**
     * @param $jid
     * @return Jid
     */
    public static function fromString($jid)
    {
        $resource = null;
        $component = false;
        if (($p = strpos($jid, '@')) !== false) {
            // For Groups and Users
            $username = substr($jid, 0, $p);
            $jid = substr($jid, $p + 1);

            if (($p = strpos($jid, '/')) !== false) {
                $hostname = substr($jid, 0, $p);
                $resource = substr($jid, $p + 1);
            } else {
                $hostname = $jid;
            }
        } else {
            // For Components
            if (($p = strpos($jid, '.')) !== false) {
                $username = substr($jid, 0, $p);
                $hostname = substr($jid, $p + 1);
                $component = true;
            } else {
                // Take care of this case. probably throw some exception
                $username = null;
                $hostname = $jid;
            }
        }
        return new Jid($username, $hostname, $resource, $component);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return null
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param null $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function getBareJidString()
    {
        return $this->username . $this->component ? '.' : '@' . $this->host;
    }

    /**
     * @return string
     */
    public function getFullJidString()
    {
        $jid = $this->getBareJidString();

        if ($this->resource != null) {
            return $jid . '/' . $this->resource;
        }
        return $jid;
    }
}

