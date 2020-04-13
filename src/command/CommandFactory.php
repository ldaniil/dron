<?php

namespace Src\Command;

class CommandFactory
{
	public const TYPE_UP = 'up';

	public const TYPE_DOWN = 'down';

	public const TYPE_LEFT = 'left';

	public const TYPE_RIGHT = 'right';

	public function getCommand($type): CommandInterface
	{
		switch ($type) {
			case self::TYPE_UP:
				return new UpCommand();
				break;

			case self::TYPE_DOWN:
				return new DownCommand();
				break;

			case self::TYPE_LEFT:
				return new LeftCommand();
				break;

			case self::TYPE_RIGHT:
				return new RightCommand();
				break;

			default:
				return new FakeCommand();
				break;
		}
	}
}
