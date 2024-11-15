<?php
/**
 * Handles setting up a base for all subscribers.
 *
 * @package TEC\Conference\Vendor\StellarWP\Telemetry\Contracts
 *
 * @license GPL-2.0-or-later
 * Modified using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace TEC\Conference\Vendor\StellarWP\Telemetry\Contracts;

use TEC\Conference\Vendor\StellarWP\ContainerContract\ContainerInterface;

/**
 * Class Abstract_Subscriber
 *
 * @package TEC\Conference\Vendor\StellarWP\Telemetry\Contracts
 */
abstract class Abstract_Subscriber implements Subscriber_Interface {

	/**
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * Constructor for the class.
	 *
	 * @param ContainerInterface $container The container.
	 */
	public function __construct( ContainerInterface $container ) {
		$this->container = $container;
	}
}
