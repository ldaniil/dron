<?php

namespace Src\Rule;

use Src\Command\CommandInterface;
use Src\Dron;

/**
 * Class WallRule
 * Данный коасс реализует логику при которой дрон вышерший
 * за пределы пределы области передвежения отскочит на 2 клетки назад назад и остановит свое движение
 *
 * @package Src\Rule
 */
class SpringRule implements RuleInterface
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

		$command
			->rollback($dron->getPosition())
			->rollback($dron->getPosition());
		$dron->setMoveError();
		return false;
	}
}
