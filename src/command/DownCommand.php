<?php

namespace Src\Command;

use Src\Cell;

class DownCommand implements CommandInterface
{
	/**
	 * @param Cell $cell
	 * @return $this
	 */
	public function execute(Cell $cell): self
	{
		$cell->decrementY();
		return $this;
	}

	/**
	 * @param Cell $cells
	 * @return $this
	 */
	public function rollback(Cell $cell): self
	{
		$cell->incrementY();
		return $this;
	}
}
