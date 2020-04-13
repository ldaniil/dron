<?php

namespace Src;

use Amp\Http\Server\Request;
use Psr\Log\LoggerInterface;
use Src\Command\CommandChain;
use Src\Command\CommandFactory;
use Src\Rule\DefaultRule;
use Src\Rule\SpringRule;
use Src\Rule\WallRule;

class Application
{
	/**
	 * @var string
	 */
	protected static $lastStopCoordinate = '0x0';

	/**
	 * @var LoggerInterface
	 */
	protected $logger;

	public function dispatch(Request $request): array
	{
		$query = $request->getUri()->getQuery();
		parse_str($query, $queryParams);

		$startPosition = $queryParams['start_position'] ?? self::$lastStopCoordinate;
		$startPosition = explode('x', $startPosition);
		$startPosition = new Cell($startPosition[0], $startPosition[1]);
		$location = new Location();
		$dron = new Dron($startPosition, $location);

		if ($this->logger) {
			$dron->setLogger($this->logger);
		}

		$chain = $queryParams['commands'];
		$commandFactory = new CommandFactory();
		$commandChain = new CommandChain($chain, $commandFactory);

		$rule = new DefaultRule();

		if (isset($queryParams['has_walls'])) {
			$hasWalls = (bool)$queryParams['has_walls'];
			$rule = $hasWalls ? new SpringRule() : new WallRule();
		}

		$dron->move($commandChain, $rule);

		if ($dron->getLocation()->haveCell($dron->getPosition())) {
			self::$lastStopCoordinate = (string)$dron->getPosition();
		}

		$position = $dron->getPosition()->__toString();

		return [
			'success' => !$dron->hasMoveError(),
			'position' => $position
		];
	}

	/**
	 * @param LoggerInterface $logger
	 * @return $this
	 */
	public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }
}