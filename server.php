<?php

require __DIR__ . '/vendor/autoload.php';

\Amp\Loop::run(function () {
	$file = yield Amp\File\open(__DIR__ . '/runtime/app.log', 'w+');

	$handler = new \Amp\Log\StreamHandler($file);
	$handler->setFormatter(new \Monolog\Formatter\LineFormatter());

	$logger = new \Monolog\Logger('app-log');
	$logger->pushHandler($handler);

	$app = new \Src\Application();
	$app->setLogger($logger);

	$servers = [
		Amp\Socket\Server::listen('0.0.0.0:1337'),
	];

	$server = new \Amp\Http\Server\HttpServer(
		$servers,
		new \Amp\Http\Server\RequestHandler\CallableRequestHandler(function (\Amp\Http\Server\Request $request) use ($app) {

			$response = $app->dispatch($request);

			return new \Amp\Http\Server\Response(\Amp\Http\Status::OK, [
				'content-type' => 'application/json; charset=utf-8'
			], json_encode($response));
		}),
		$logger
	);

	yield $server->start();
});