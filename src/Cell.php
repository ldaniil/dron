<?php

namespace Src;

class Cell
{
	/**
	 * @var int
	 */
	protected $x;

	/**
	 * @var int
	 */
	protected $y;

	/**
	 * Cell constructor.
	 *
	 * @param int $x
	 * @param int $y
	 */
	public function __construct(int $x = 0, int $y = 0)
	{
		$this->x = $x;
		$this->y = $y;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->x . 'x' . $this->y;
	}

	/**
	 * @return int
	 */
	public function getX(): int
	{
		return $this->x;
	}

	/**
	 * @return int
	 */
	public function getY(): int
	{
		return $this->y;
	}

	/**
	 * @param int $step
	 * @return $this
	 */
	public function incrementX(int $step = 1): self
	{
		$this->x += $step;
		return $this;
	}

	/**
	 * @param int $step
	 * @return $this
	 */
	public function decrementX(int $step = 1): self
	{
		$this->x -= $step;
		return $this;
	}

	/**
	 * @param int $step
	 * @return $this
	 */
	public function incrementY(int $step = 1): self
	{
		$this->y += $step;
		return $this;
	}

	/**
	 * @param int $step
	 * @return $this
	 */
	public function decrementY(int $step = 1): self
	{
		$this->y -= $step;
		return $this;
	}
}
