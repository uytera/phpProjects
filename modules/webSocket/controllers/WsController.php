<?php
namespace app\modules\webSocket\controllers;

use Amp\Loop;
use Amp\Websocket\Server\Websocket;
use yii\console\Controller;
use Amp\Http\Server\HttpServer;
use Amp\Http\Server\Router;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Socket\Server as SocketServer;
use Monolog\Logger;
use yii\console\ExitCode;
use function Amp\ByteStream\getStdout;
use Amp\Promise;


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
        $this -> ws = new Websocket(new wsHandler());
    }

    public function actionRun(){
        Loop::run(function (): Promise {
            $sockets = [
                SocketServer::listen('0.0.0.0:1337')
            ];

            $router = new Router;
            $router->addRoute('GET', '/broadcast', $this->ws);
            $router->addRoute('GET', '/list', $this->ws);

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




