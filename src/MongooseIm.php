<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/3/2018
 * Time: 8:37 AM
 */

namespace MongooseIm;

use MongooseIm\Commands\Contracts\MongooseImCommand;
use MongooseIm\Commands\CreateUser;
use MongooseIm\Commands\SendMessage;
use MongooseIm\Exceptions\MongooseImException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

/**
 * Class MongooseIm
 * @package MongooseIm
 */
class MongooseIm
{
    private $api = '';
    private $user = '';
    private $password = '';
    private $domain = '';
    private $conference_domain = '';

    private $debug = '';

    public function __construct($config)
    {
        $this->api = $config['api'];// config('mongoose-im.api', '');
        $this->user = $config['user'];// config('mongoose-im.username', '');
        $this->password = $config['password'];//config('mongoose-im.password', '');
        $this->domain = $config['domain'];
        $this->conference_domain = $config['conference_domain'];

        $this->debug = $config['debug'];
    }

    /**
     * @param MongooseImCommand $command
     * @return null|\Psr\Http\Message\StreamInterface
     * @throws MongooseImException
     */
    public function execute(MongooseImCommand $command)
    {
        $client = new Client([
            'verify' => false,
            'base_uri' => $this->api
        ]);
        //TODO: Add Host
        $url = $command->url();
        try {
            $response = $client->request($command->method(), $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'json' => $command->data()
            ]);
            if ($this->debug) {
                Log::info($command->url() . 'executed successfully.');
            }
            return $response->getBody();
        } catch (GuzzleException $e) {
            if ($this->debug) {
                Log::info("Error occurred while executing the command " . $command->url() . ".");
            }
            throw MongooseImException::networkException($e);
        } catch (\Exception $e) {
            if ($this->debug) {
                Log::info("Error occurred while executing the command " . $command->url() . ".");
            }
            throw MongooseImException::generalException($e);
        }
    }

    /**
     * @param MongooseImCommand $command
     */
    public function executeQueue(MongooseImCommand $command)
    {
    }

    /**
     * @param CreateUser $createUser
     * @return null|\Psr\Http\Message\StreamInterface
     * @throws MongooseImException
     */
    public function createUser(CreateUser $createUser)
    {
        return $this->execute($createUser);
    }

    /**
     * @param SendMessage $sendMessage
     * @return null|\Psr\Http\Message\StreamInterface
     * @throws MongooseImException
     */
    public function sendMessage(SendMessage $sendMessage)
    {
        return $this->execute($sendMessage);
    }
}
