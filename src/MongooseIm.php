<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/3/2018
 * Time: 8:37 AM
 */

namespace MongooseIm;

use MongooseIm\Commands\Contracts\MongooseImCommand;
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
    private $domain = '';
    private $muc_domain = '';
    private $muc_light_domain = '';

    private $debug = false;
    private $config;

    public function __construct($config)
    {
        $this->api = $config['api'];
        $this->domain = $config['domain'];
        $this->muc_domain = $config['muc_domain'];
        $this->muc_light_domain = $config['muc_light_domain'];
        $this->debug = $config['debug'];
        $this->config = $config;
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

        if (method_exists($command, 'setConfig')) {
            $command->setConfig($this->config);
        }
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
