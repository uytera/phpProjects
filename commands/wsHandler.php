<?php
use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Promise;
use Amp\Success;
use Amp\Websocket\Client;
use Amp\Websocket\Message;
use Amp\Websocket\Server\ClientHandler;
use Amp\Websocket\Server\Endpoint;
use function Amp\call;

/**
 * Class wsHandler
 */
class wsHandler implements ClientHandler
{

    private const ALLOWED_ORIGINS = [
        'http://localhost:1337',
        'http://127.0.0.1:1337',
        'http://[::1]:1337'
    ];

    public function handleHandshake(Endpoint $endpoint, Request $request, Response $response): Promise
    {
        if (!\in_array($request->getHeader('origin'), self::ALLOWED_ORIGINS, true)) {
            return $endpoint->getErrorHandler()->handleError(403);
        }

        return new Success($response);
    }

    public function handleClient(Endpoint $endpoint, Client $client, Request $request, Response $response): Promise
    {
        return call(function () use ($endpoint, $client): \Generator {
            while ($message = yield $client->receive()) {
                \assert($message instanceof Message);
                $endpoint->broadcast(\sprintf(
                    '%d: %s',
                    $client->getId(),
                    yield $message->buffer()
                ));
            }
        });
    }
}