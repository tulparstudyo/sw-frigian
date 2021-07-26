<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2020
 * @package Client
 * @subpackage JsonApi
 */


namespace Aimeos\Client\JsonApi\Techie;


/**
 * Factory for techie JSON API client
 *
 * @package Client
 * @subpackage JsonApi
 */
class Factory
	extends \Aimeos\Client\JsonApi\Common\Factory\Base
	implements \Aimeos\Client\JsonApi\Common\Factory\Iface
{
	/**
	 * Creates a techie client object.
	 *
	 * @param \Aimeos\MShop\Context\Item\Iface $context Shop context instance with necessary objects
	 * @param string $path Name of the client separated by slashes, e.g "techie"
	 * @param string|null $name Client name (default: "Standard")
	 * @return \Aimeos\Client\JsonApi\Iface JSON API client
	 * @throws \Aimeos\Client\JsonApi\Exception If requested client implementation couldn't be found or initialisation fails
	 */
	public static function create( \Aimeos\MShop\Context\Item\Iface $context, string $path, string $name = null ) : \Aimeos\Client\JsonApi\Iface
	{
		if( ctype_alnum( $path ) === false ) {
			throw new \Aimeos\Client\JsonApi\Exception( sprintf( 'Invalid client "%1$s"', $path ), 400 );
		}

		if( $name === null ) {
			$name = $context->getConfig()->get( 'client/jsonapi/techie/name', 'Standard' );
		}

		$iface = '\\Aimeos\\Client\\JsonApi\\Iface';
		$classname = '\\Aimeos\\Client\\JsonApi\\Techie\\' . $name;

		if( ctype_alnum( $name ) === false ) {
			throw new \Aimeos\Client\JsonApi\Exception( sprintf( 'Invalid characters in class name "%1$s"', $classname ) );
		}

		$client = self::createClient( $classname, $iface, $context, $path );

		$client = self::addClientDecorators( $client, $context, $path );

		return $client->setView( $context->getView() );
	}

}
