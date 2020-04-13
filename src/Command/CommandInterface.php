<?php

namespace Src\Command;

use Src\Cell;

interface CommandInterface
{
	public function execute(Cell $cell);
	public function rollback(Cell $cell);
}