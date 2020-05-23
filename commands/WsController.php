<?php


namespace app\commands;

use Amp\Loop;
use Amp\Socket\SocketException;
use Amp\Websocket\Server\Websocket;
use app\models\Telemetry;
use wsHandler;
use yii\console\Controller;
use Amp\Http\Server\HttpServer;
use Amp\Http\Server\Router;
use Amp\Http\Server\StaticContent\DocumentRoot;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Socket\Server as SocketServer;
use Monolog\Logger;
use yii\console\ExitCode;
use function Amp\ByteStream\getStdout;
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
 * Обработка WS
 */
class WsController extends Controller
{
    /**
     * @var Websocket
     */
    public $ws;

    public  function  init()
    {
        parent::init();
        $this -> ws = new Websocket(new wsHandlerV2());
    }

    public function actionRun(){
        Loop::run(function (): Promise {
            $sockets = [
                SocketServer::listen('0.0.0.0:1337')
            ];

            $router = new Router;
            $router->addRoute('GET', '/broadcast', $this->ws);
            $router->setFallback(new DocumentRoot(__DIR__ . '/../web/public'));

            $logHandler = new StreamHandler(getStdout());
            $logHandler->setFormatter(new ConsoleFormatter);
            $logger = new Logger('server');
            $logger->pushHandler($logHandler);

            $server = new HttpServer($sockets, $router, $logger);

            return $server->start();
        });

        return ExitCode::OK;
    }
}

class wsHandlerV2 implements ClientHandler
{

    private const ALLOWED_ORIGINS = [
        'http://localhost:1337',
        'http://0.0.0.0:1337',
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
                assert($message instanceof Message);
                Telemetry::AddTelemetry(urlencode(yield $message->buffer()));
                $endpoint->broadcast(sprintf('%d: %s', $client->getId(), yield $message->buffer()));
            }
        });
    }
}




