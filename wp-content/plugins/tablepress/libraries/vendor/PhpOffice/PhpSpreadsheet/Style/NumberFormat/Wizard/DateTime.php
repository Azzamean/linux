<?php

namespace TablePress\PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard;

class DateTime extends DateTimeWizard
{
	/**
	 * @var string[]
	 */
	protected $separators;

	/**
	 * @var array<DateTimeWizard|string>
	 */
	protected $formatBlocks;

	/**
	 * @param null|string|string[] $separators
	 *          If you want to use only a single format block, then pass a null as the separator argument
	 * @param DateTimeWizard|string ...$formatBlocks
	 */
	public function __construct($separators, ...$formatBlocks)
	{
		$this->separators = $this->padSeparatorArray(
			is_array($separators) ? $separators : [$separators],
			count($formatBlocks) - 1
		);
		$this->formatBlocks = array_map([$this, 'mapFormatBlocks'], $formatBlocks);
	}

	/**
	 * @param \TablePress\PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\DateTimeWizard|string $value
	 */
	private function mapFormatBlocks($value): string
	{
		// Any date masking codes are returned as lower case values
		if (is_object($value)) {
			// We can't explicitly test for Stringable until PHP >= 8.0
			return $value;
		}

		// Wrap any string literals in quotes, so that they're clearly defined as string literals
		return $this->wrapLiteral($value);
	}

	public function format(): string
	{
		return implode('', array_map([$this, 'intersperse'], $this->formatBlocks, $this->separators));
	}
}
