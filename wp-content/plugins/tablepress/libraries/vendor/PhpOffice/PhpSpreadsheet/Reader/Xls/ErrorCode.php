<?php

namespace TablePress\PhpOffice\PhpSpreadsheet\Reader\Xls;

class ErrorCode
{
	private const ERROR_CODE_MAP = [
		0x00 => '#NULL!',
		0x07 => '#DIV/0!',
		0x0F => '#VALUE!',
		0x17 => '#REF!',
		0x1D => '#NAME?',
		0x24 => '#NUM!',
		0x2A => '#N/A',
	];

	/**
	 * Map error code, e.g. '#N/A'.
	 * @return string|bool
	 */
	public static function lookup(int $code)
	{
		return self::ERROR_CODE_MAP[$code] ?? false;
	}
}
