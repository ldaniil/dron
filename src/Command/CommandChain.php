<?php

namespace Src\Command;

class CommandChain implements \Iterator
{
	/**
	 * @var array
	 */
	private $commands = [];

	/**
	 * @var int
	 */
	private $pointer = 0;

	public function __construct(string $chain, CommandFactory $factory, $delimiter = ',')
	{
		$types = explode($delimiter, $chain);

		foreach ($types as $type) {
			$this->commands[$this->pointer] = $factory->getCommand($type);
			$this->pointer++;
		}
	}

	public function current(): CommandInterface
	{
		return $this->commands[$this->pointer];
	}

	public function next(): void
	{
		++$this->pointer;
	}

	public function key(): int
	{
		return $this->pointer;
	}

	public function valid(): bool
	{
		return isset($this->commands[$this->pointer]);
	}

	public function rewind(): bool
	{
		$this->pointer = 0;
		return true;
	}
}
