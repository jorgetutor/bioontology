<?php

namespace Tutor\Bioontology;

use Guzzle\Service\Loader\JsonLoader;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Symfony\Component\Config\FileLocator;

/**
 * A BioontologyClient.
 */
class BioontologyClient extends GuzzleClient
{
    /**
     * Factory method to create a new BioontologyClient.
     *
     * @param array $config Configuration data
     * @return BioontologyClient
     * @throws \Exception
     */
    public static function factory($config = [])
    {
        $clientConfig = self::getClientConfig($config);
        $guzzleClient = new Client($clientConfig);
        $description = self::getAPIDescriptionByJsonFile('services.json');
        $client = new GuzzleClient($guzzleClient, $description);
        return $client;
    }

    /**
     * Gets API Description from a json file.
     *
     * @param string file
     *   Service file name.
     */
    protected static function getAPIDescriptionByJsonFile($file)
    {
        $configDirectories = [__DIR__];
        $locator = new FileLocator($configDirectories);
        $jsonLoader = new JsonLoader($locator);
        $description = $jsonLoader->load($locator->locate($file));
        $description = new Description($description);
        return $description;
    }

    /**
     * Gets Guzzle client config.
     *
     * @param array config
     *   - apikey: String
     *   - debug: Boolean
     */
    protected static function getClientConfig($config)
    {
        $clientConfig = [];
        if (isset($config['apikey'])) {
            // Authorization: apikey token=your_apikey
            $clientConfig['headers'] = [
                'Authorization' => 'apikey token=' . $config['apikey']
            ];
        }
        else {
            throw new \Exception('Provide authentication details');
        }

        if (isset($config['debug']) && is_bool($config['debug'])) {
            $clientConfig['debug'] = $config['debug'];
        }
        return $clientConfig;
    }

    /**
     * Shortcut for executing Commands in the Definitions.
     *
     * @param string $method
     * @param array|null $args
     *
     * @return mixed|void
     */
    public function __call($method, array $args)
    {
        $commandName = ucfirst($method);
        /** @var \GuzzleHttp\Command\Result $result */
        $result = parent::__call($commandName, $args);
        return $result;
    }
}
