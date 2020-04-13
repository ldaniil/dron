<?php

namespace Src\Command;

use Src\Cell;

class LeftCommand implements CommandInterface
{
	/**
	 * @param Cell $cell
	 * @return $this
	 */
	public function execute(Cell $cell): self
	{
		$cell->decrementX();
		return $this;
	}

	/**
	 * @param Cell $cell
	 * @return $this
	 */
	public function rollback(Cell $cell): self
	{
		$cell->incrementX();
		return $this;
	}
}
