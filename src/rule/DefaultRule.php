<?php

namespace Src\Rule;

use Src\Command\CommandInterface;
use Src\Dron;

/**
 * Class DefaultRule
 * Данный коасс реализует логику при которой дрон вышерший
 * за пределы пределы области передвежения сразу остановит свое движение
 *
 * @package Src\Rule
 */
class DefaultRule implements RuleInterface
{
	/**
	 * @param Dron             $dron
	 * @param CommandInterface $command
	 *
	 * @return bool
	 */
	public function execute(Dron $dron, CommandInterface $command): bool
	{
		$location = $dron->getLocation();

		if ($location->haveCell($dron->getPosition())) {
			return true;
		}

		$dron->setMoveError();
		return false;
	}
}
