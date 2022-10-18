<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kibet
 * Date: 2/15/2019
 * Time: 9:09 AM
 */

namespace MongooseIm\Commands;


use MongooseIm\Commands\Contracts\MongooseImCommand;
use MongooseIm\Traits\ConfigAwareCommand;
use MongooseIm\Xmpp\Jid;

class SendMessage implements MongooseImCommand
{
    use ConfigAwareCommand;
    /**
     * @var Jid
     */
    private $to;

    /**
     * @var
     */
    private $body;

    /**
     * @var Jid
     */
    private $from;

    /**
     * SendMessage constructor.
     * @param Jid $to
     * @param Jid $from
     * @param $body
     */
    public function __construct(Jid $to, Jid $from, $body)
    {
        $this->to = $to;
        $this->body = $body;
        $this->from = $from;
    }

    /**
     * @return boolean
     */
    public function isRoomMessage()
    {
        return $this->to->getHost() == $this->getMucLightDomain()
            || $this->to->getHost() == $this->getMucDomain();
    }

    /**
     * @return string
     */
    public function url()
    {
        if (!$this->isRoomMessage()) {
            return 'messages';
        }
        return 'muc-lights/' . $this->getMucLightDomain() . '/' . $this->to->getUsername() . '/messages';
    }

    /**
     * @return string
     */
    public function urlPrepend()
    {
        // Append Name of group. Which technically is
        return $this->isRoomMessage() ? $this->to->getUsername() : '';
    }

    /**
     * @return array
     */
    public function data()
    {
        /**
         * Room Message
         *
         * {
         * "from": "alice@wonderland.lit",
         * "body": "A test message"
         * }
         *
         * One-to-one
         * {
         * "caller": "alice@wonderland.lit",
         * "to": "rabbit@wonderland.lit",
         * "body": "Hi Rabbit!"
         * }
         */
        if ($this->isRoomMessage()) {
            return [
                'from' => $this->from->getBareJidString(),
                'body' => $this->body
            ];
        }
        return [
            'caller' => $this->from->getBareJidString(),
            'to' => $this->to->getBareJidString(),
            'body' => $this->body
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
        return 'application/json';
    }
}
