<?php

namespace Src\Command;

use Src\Cell;

class FakeCommand implements CommandInterface
{
	/**
	 * @param Cell $cell
	 * @return $this
	 */
	public function execute(Cell $cell): self
	{
		return $this;
	}

	/**
	 * @param Cell $cell
	 * @return $this
	 */
	public function rollback(Cell $cell): self
	{
		return $this;
	}
}