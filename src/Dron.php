<?php

namespace Src;

use Psr\Log\LoggerInterface;
use Src\Command\CommandChain;
use Src\Rule\RuleInterface;

class Dron
{
	protected static $number;

	/**
	 * @var Cell
	 */
	protected $position;

	/**
	 * @var Location
	 */
	protected $location;

	/**
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 * @var bool
	 */
	protected $hasMoveError = false;

	/**
	 * Dron constructor.
	 *
	 * @param Cell     $startPosition
	 * @param Location $location
	 */
	public function __construct(Cell $startPosition, Location $location)
	{
		self::$number++;

		$this->position = $startPosition;
		$this->lastPosition = $startPosition;
		$this->location = $location;
	}

	/**
	 * @return Cell
	 */
	public function getPosition(): Cell
	{
		return $this->position;
	}

	/**
	 * @return Location
	 */
	public function getLocation(): Location
	{
		return $this->location;
	}

	/**
	 * @return $this
	 */
	public function setMoveError(): self
	{
		$this->hasMoveError = true;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasMoveError(): bool
	{
		return $this->hasMoveError;
	}

	/**
	 * @param CommandChain  $commands
	 * @param RuleInterface $rule
	 */
	public function move(CommandChain $commands, RuleInterface $rule): void
	{
		foreach ($commands as $command) {
			$command->execute($this->position);

			if ($this->logger) {
				$this->logger->info('Dron#' . self::$number . ' in ' . $this->position);
			}

			if (!$rule->execute($this, $command)) {
				break;
			}
		}
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
