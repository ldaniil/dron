<?php

namespace Src\Command;

use Src\Cell;

class UpCommand implements CommandInterface
{
	/**
	 * @param Cell $cell
	 * @return $this
	 */
	public function execute(Cell $cell): self
	{
		$cell->incrementY();
		return $this;
	}

	/**
	 * @param Cell $cell
	 * @return Cell
	 */
	public function rollback(Cell $cell): self
	{
		$cell->decrementY();
		return $this;
	}
}
