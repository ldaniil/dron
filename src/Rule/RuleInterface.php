<?php

namespace Src\Rule;

use MongoDB\Driver\Command;
use Src\Command\CommandInterface;
use Src\Dron;

interface RuleInterface
{
	public function execute(Dron $dron, CommandInterface $command): bool;
}
