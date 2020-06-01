<?php


namespace app\modules\webSocket\controllers;


use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Promise;
use Amp\Success;
use Amp\Websocket\Client;
use Amp\Websocket\Message;
use Amp\Websocket\Server\ClientHandler;
use Amp\Websocket\Server\Endpoint;
use app\models\Telemetry;
use function Amp\call;

class wsHandler implements ClientHandler
{

    private const ALLOWED_ORIGINS = [
        'http://localhost:1337',
        'http://localhost:8500',
        'http://0.0.0.0:1337',
    ];

    public function handleHandshake(Endpoint $endpoint, Request $request, Response $response): Promise
    {
        if (!\in_array($request->getHeader('origin'), self::ALLOWED_ORIGINS, true)) {
            echo $request->getHeader('origin');
            return $endpoint->getErrorHandler()->handleError(403);
        }

        return new Success($response);
    }

    public function handleClient(Endpoint $endpoint, Client $client, Request $request, Response $response): Promise
    {
        return call(function () use ($endpoint, $client): \Generator {
            while ($message = yield $client->receive()) {
                assert($message instanceof Message);
                $currentW = new Telemetry();
                $currentW->id = null;
                $currentW->telemetry = yield $message->buffer();
                $currentW->save(false);
                $endpoint->broadcast(sprintf('%d: %s', $client->getId(), yield $message->buffer()));
            }
        });
    }
}