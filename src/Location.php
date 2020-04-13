<?php

namespace Src;

class Location
{
	/**
	 * @var int
	 */
	protected $width;

	/**
	 * @var int
	 */
	protected $height;

	/**
	 * Location constructor.
	 *
	 * @param int $width
	 * @param int $height
	 */
	public function __construct(int $width = 100, int $height = 100)
	{
		$this->width = $width;
		$this->height = $height;
	}

	/**
	 * @param Cell $cell
	 *
	 * @return bool
	 */
	public function haveCell(Cell $cell) :bool
	{
		if ($cell->getX() < 0 || $cell->getY() < 0) {
			return false;
		}

		if ($cell->getX() + 1 > $this->width) {
			return false;
		}

		if ($cell->getY() + 1 > $this->height) {
			return false;
		}

		return true;
	}
}