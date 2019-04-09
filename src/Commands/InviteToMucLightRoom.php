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
class InviteToMucLightRoom implements MongooseImCommand
{
    use ConfigAwareCommand;
    /**
     * @var Jid
     */
    private $sender_jid;

    /**
     * @var Jid
     */
    private $recipient_jid;

    /**
     * @var Jid
     */
    private $group_jid;

    /**
     * CreateMucLightRoom constructor.
     * @param Jid $sender_jid
     * @param Jid $recipient_jid
     * @param $group_jid
     */
    public function __construct(Jid $sender_jid, Jid $recipient_jid, Jid $group_jid)
    {
        $this->sender_jid = $sender_jid;
        $this->recipient_jid = $recipient_jid;
        $this->group_jid = $group_jid;
    }

    /**
     * @return string
     */
    public function url()
    {
        return 'muc-lights/' . $this->getMucLightDomain() . '/' . $this->group_jid->getUsername() . '/participants';
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'sender' => $this->sender_jid->getBareJidString(),
            'recipient' => $this->recipient_jid->getBareJidString(),
        ];
    }

    /**
     * @return string
     */
    public function method()
    {
        return 'POST';
    }


    /** @return string */
    public function accept()
    {
        return 'applications/json';
    }
}
