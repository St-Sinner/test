<?php

declare(strict_types=1);

namespace App\Clients;

use App\Interfaces\ExternalCalculateInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Log\LoggerInterface;

class ExternalCalculateClient implements ExternalCalculateInterface
{
    private ClientInterface $client;

    private string $url;

    private LoggerInterface $logger;

    private ?string $logChannel;

    public function __construct(string $url, ClientInterface $client, LoggerInterface $logger, ?string $logChannel = 'external-client')
    {
        $this->client = $client;
        $this->url = $url;
        $this->logger = $logger;
        $this->logChannel = $logChannel;
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function priceProduct(array $data): array
    {
        return $this->request('POST', $this->url, $data);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    private function request(string $method, string $uri, array $options = []): array
    {
        $this->info('Request: ' . json_encode($options));
        $request = $this->client->request($method, $uri, $options);
        $response = $request->getBody()->getContents();
        $this->info('Response: ' . $response);

        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }

    private function info($message): void
    {
        $logger = $this->logger;
        if (method_exists($logger, 'channel') && $this->logChannel) {
            $logger = $logger->channel($this->logChannel);
        }
        $logger->info($message);
    }
}
