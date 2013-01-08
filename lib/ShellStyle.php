<?php
/*
 * This file is part of the ShellStyle package.
 *
 * (c) Sergey Kamardin <gobwas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * ShellStyle prepares ANSI-encoded colored Unix/Linux output
 *
 * @example $style = new ShellStyle(array(ShellStyle::FOREGROUND_GREEN));
 * @example echo $style->parse('Hello, styled World!')."\n";
 *
 * @author Sergey Kamardin <gobwas@gmail.com>
 * @license GPL3
 */
class ShellStyle
{
	const FOREGROUND_BLACK   = 30;
	const BACKGROUND_BLACK   = 40;
	const FOREGROUND_RED     = 31;
	const BACKGROUND_RED     = 41;
	const FOREGROUND_GREEN   = 32;
	const BACKGROUND_GREEN   = 42;
	const FOREGROUND_YELLOW  = 33;
	const BACKGROUND_YELLOW  = 43;
	const FOREGROUND_BLUE    = 34;
	const BACKGROUND_BLUE    = 44;
	const FOREGROUND_MAGENTA = 35;
	const BACKGROUND_MAGENTA = 45;
	const FOREGROUND_CYAN    = 36;
	const BACKGROUND_CYAN    = 46;
	const FOREGROUND_WHITE   = 37;
	const BACKGROUND_WHITE   = 47;

	const STYLE_NORMAL       = 0;
	const STYLE_BOLD         = 1;
	const STYLE_UNDERLINED   = 4;
	const STYLE_BLINKING     = 5;
	const STYLE_REVERSE      = 7;

	const PREFIX = "\033[";
	const DELIMITER = "m";
	const DEFAULT_SET = "\033[0m";

	/**
	 * List of defined constants (need for enum functionality)
	 * @var array|null
	 */
	private static $constants = null;

	/**
	 * List of added styles
	 * @var array
	 */
	protected $styles = array();

	/**
	 * Constructor.
	 * Adds list of styles, if given $styles parameter.
	 *
	 * @param array $styles
	 */
	public function __construct(array $styles = array())
	{
		foreach ($styles as $style) {
			$this->addStyle($style);
		}
	}

	/**
	 * Adds style to the styles list.
	 * Can be used in chain-style code.
	 *
	 * @example $style->addStyle(ShellStyle::BACKGROUND_WHITE);
	 *
	 * @param integer $style
	 * @return ShellStyle
	 */
	public function addStyle($style)
	{
		if (in_array($style, self::getConstants()) and is_int($style)) {
			$this->styles[] = $style;
		};

		return $this;
	}

	/**
	 * Prepares styled output string with given text
	 *
	 * @param string $string
	 * @return string
	 */
	public function parse($string = '')
	{
		return sprintf(
			"%s%s%s%s%s",
			self::PREFIX,
			implode(';', $this->styles),
			self::DELIMITER,
			(string) $string,
			self::DEFAULT_SET
		);
	}

	/**
	 * Returns a list of defined constants
	 *
	 * @return array
	 */
	final public static function getConstants()
	{
		if (is_null(self::$constants)) {
			$reflection = new ReflectionClass(get_called_class());
			self::$constants = $reflection->getConstants();
		}

		return self::$constants;
	}
}
