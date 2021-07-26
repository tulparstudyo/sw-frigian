<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2020
 * @package Client
 * @subpackage JsonApi
 */


namespace Aimeos\Client\JsonApi\Frigian;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * JSON API standard client
 *
 * @package Client
 * @subpackage JsonApi
 */
class Standard
	extends \Aimeos\Client\JsonApi\Base
	implements \Aimeos\Client\JsonApi\Iface
{
	/**
	 * Returns the resource or the resource list
	 *
	 * @param \Psr\Http\Message\ServerRequestInterface $request Request object
	 * @param \Psr\Http\Message\ResponseInterface $response Response object
	 * @return \Psr\Http\Message\ResponseInterface Modified response object
	 */
	public function get( ServerRequestInterface $request, ResponseInterface $response ) : \Psr\Http\Message\ResponseInterface
	{

		$view = $this->getView();
		$tplconf = 'client/jsonapi/frigian/standard/template';
		$default = 'frigian/standard';

		try
		{
            frigian_options();
			$ref = $view->param( 'include', ['media', 'price', 'text'] );

			if( is_string( $ref ) ) {
				$ref = explode( ',', $ref );
			}

			if( ( $legal = $view->param( 'legal' ) ) != '' )
			{
                $default = 'frigian/legal';
				$view->name = $legal;
				$view->content = $this->get_legal($legal);
			}
			else
			{
				$view->items = map();
				$view->total = count( $view->items );
			}

			$status = 200;
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$status = 404;
			$view->errors = $this->getErrorDetails( $e, 'mshop' );
		}
		catch( \Exception $e )
		{
			$status = $e->getCode() >= 100 && $e->getCode() < 600 ? $e->getCode() : 500;
			$view->errors = $this->getErrorDetails( $e );
		}
		$body = $view->render( $view->config( $tplconf, $default ) );

		return $response->withHeader( 'Allow', 'GET,OPTIONS' )
			->withHeader( 'Cache-Control', 'max-age=300' )
			->withHeader( 'Content-Type', 'application/vnd.api+json' )
			->withBody( $view->response()->createStreamFromString( $body ) )
			->withStatus( $status );
	}
    private function get_legal($legal){
         return frigian_option($legal);
    }

	/**
	 * Returns the available REST verbs and the available parameters
	 *
	 * @param \Psr\Http\Message\ServerRequestInterface $request Request object
	 * @param \Psr\Http\Message\ResponseInterface $response Response object
	 * @return \Psr\Http\Message\ResponseInterface Modified response object
	 */
	public function options( ServerRequestInterface $request, ResponseInterface $response ) : \Psr\Http\Message\ResponseInterface
	{
		$view = $this->getView();

		$view->filter = [
			'cs_type' => [
				'label' => 'Type of the frigian items that should be returned ("delivery" or "payment")',
				'type' => 'string', 'default' => '', 'required' => false,
			],
		];

		$tplconf = 'client/jsonapi/standard/template-options';
		$default = 'options-standard';

		$body = $view->render( $view->config( $tplconf, $default ) );

		return $response->withHeader( 'Allow', 'GET,OPTIONS' )
			->withHeader( 'Cache-Control', 'max-age=300' )
			->withHeader( 'Content-Type', 'application/vnd.api+json' )
			->withBody( $view->response()->createStreamFromString( $body ) )
			->withStatus( 200 );
	}
}
