<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2020
 * @package Client
 * @subpackage Html
 */

namespace Aimeos\Client\Html\Swordbros\Frigian\Widget;

/**
 * Factory for product profile HTML client in user accounts.
 *
 * @package Client
 * @subpackage Html
 */
class Factory
	extends \Aimeos\Client\Html\Common\Factory\Base
	implements \Aimeos\Client\Html\Common\Factory\Iface
{
	/**
	 * Creates a account profile client object.
	 */
	public static function create( \Aimeos\MShop\Context\Item\Iface $context, string $name = null ) : \Aimeos\Client\Html\Iface
	{
    if( $name === null ) {
			$name = $context->getConfig()->get( 'client/html/widget', 'Standard' );
		}

		$iface = '\\Aimeos\\Client\\Html\\Iface';
		$classname = '\\Aimeos\\Client\\Html\\Swordbros\\Frigian\\Widget\\' . $name;

		if( ctype_alnum( $name ) === false ) {
			throw new \Aimeos\Client\Html\Exception( sprintf( 'Invalid characters in class name "%1$s"', $classname ) );
		}

		$client = self::createClient( $context, $classname, $iface );
		$client = self::addClientDecorators( $context, $client, 'frigian/widget' );
		return $client->setObject( $client );
	}

}
