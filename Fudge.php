<?php

/**
 * Need to make some numbers look nicer? No worries, fudge them!
 * @author dennis.hotson@gmail.com <Dennis Hotson>
 */
class Fudge
{
	/**
	 * Makes a number look nicer
	 * @param $n int
	 *  3 - 30 rounds to the nearest 1
	 *  30 - 300 rounds to the nearest 10
	 *  300 - 3000 rounds to the nearest 100
	 */
	public static function round($n)
	{
		return self::_round($n, self::_accuracy($n));
	}

	/**
	 * Makes a number look like a bargain price
	 * @param $n int
	 */
	public static function price($n)
	{
		$accuracy = self::_accuracy($n);

		if (self::_accuracy($n, 3) < self::_accuracy($n, 1))
			$adjustment = $accuracy / 10; // eg. Numbers between 100 - 300 .. adjusted by -1
		else
			$adjustment = $accuracy / 20; // eg. Numbers between 300 - 1000 .. adjusted by -5

		return self::_round($n, self::_accuracy($n)) - $adjustment;
	}

	// ---

	/**
	 * @param $n int
	 * @param $offset
	 * @return int A power of 10 eg 1,10,100....
	 */
	private static function _accuracy($n, $offset = 3)
	{
		return pow(10, floor(log10(max(1, $n)) - log10($offset)));
	}

	/**
	 * Rounds $n to the nearest $accuracy
	 */
	private static function _round($n, $accuracy)
	{
		return round($n / $accuracy) * $accuracy;
	}
}
