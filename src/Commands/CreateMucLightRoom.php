<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kibet
 * Date: 2/14/2019
 * Time: 4:43 PM
 */

namespace MongooseIm\Commands;

use MongooseIm\Commands\Contracts\MongooseImCommand;
use MongooseIm\Traits\ConfigAwareCommand;
use MongooseIm\Xmpp\Jid;

/**
 * Class CreateMucLightRoom
 * @package MongooseIm
 */
class CreateMucLightRoom implements MongooseImCommand
{
    use ConfigAwareCommand;
    /**
     * @var
     * will form the username part for the jid
     */
    private $id;

    /**
     * @var Jid
     */
    private $owner_jid;

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $subject;

    /**
     * CreateMucLightRoom constructor.
     * @param $id
     * @param Jid $owner_jid
     * @param $subject
     */
    public function __construct($id, Jid $owner_jid, $subject)
    {
        $this->id = $id;
        $this->owner_jid = $owner_jid;
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function url()
    {
        return 'muc-lights/' . $this->getDomain();
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'id' => $this->id,
            'owner' => $this->owner_jid->getBareJidString(),
            'name' => $this->id,
            'subject' => $this->subject
        ];
    }

    /**
     * @return string
     */
    public function method()
    {
        return 'PUT';
    }


    /** @return string */
    public function accept()
    {
        return 'applications/json';
    }
}
