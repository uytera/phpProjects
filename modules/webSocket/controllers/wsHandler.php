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
use Throwable;
use yii\db\Exception;
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
                $msg = yield $message->buffer();

                $data = json_decode($msg, true);
                if (!array_key_exists('action', $data)) {
                    $client->send(json_encode(['result' => 'error', 'data' => "wrong request"]));
                    continue;
                }

                switch ($data['action']) {
                    case 'put':
                        try {
                            if (array_key_exists('message', $data)) {
                                $currentW = new Telemetry();
                                $currentW->id = null;
                                $currentW->telemetry = $data['message'];
                                $currentW->save(false);
                                $client->send(json_encode(['result' => 'ok', 'data' => $data['message']]));
                            } else {
                                $client->send(json_encode(['result' => 'error', 'data' => "wrong request"]));
                            }
                        } catch (Throwable $e) {
                            $client->send(json_encode(['result' => 'error', 'data' => "wrong data"]));
                        }
                        break;
                    case 'get':
                        try {
                            if (array_key_exists('id', $data)) {
                                $telemetry = Telemetry::findOne($data['id']);
                                $client->send(json_encode(['result' => 'ok', 'data' => $telemetry->telemetry]));
                            } else {
                                $client->send(json_encode(['result' => 'error', 'data' => "wrong request"]));
                            }
                        } catch (Throwable $e) {
                            $client->send(json_encode(['result' => 'error', 'data' => "wrong data"]));
                        }
                        break;
                    default:
                        continue;
                }
            }
        });
    }
}