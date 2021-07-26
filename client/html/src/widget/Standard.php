<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2020
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Swordbros\Frigian\Widget;


/**
 * Default implementation of account widget HTML client.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Iface
{

	private $subPartPath = 'client/html/widget';
	private $subPartNames = [];
	private $view;


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody(string $widget = '',  string $uid = '') : string
	{
		$context = $this->getContext();
		$view = $this->getView();

		try
		{
			if( !isset( $this->view ) ) {
				$view = $this->view = $this->getObject()->addData( $view );
			}

			$html = '';
			foreach( $this->getSubClients() as $subclient ) {
				$html .= $subclient->setView( $view )->getBody( $uid );
			}
			$view->widgetBody = $html;
		}
		catch( \Aimeos\Client\Html\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
		}
		catch( \Aimeos\Controller\Frontend\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
		}
		catch( \Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
			$this->logException( $e );
		}
		if($widget) $widget = rtrim(ltrim($widget, '/'), '/').'/';
		$tplconf = 'client/html/swordbros/frigian/widget/template-body';
		$default = 'widget/'.$widget.'body-standard';

		return $view->render( $view->config( $tplconf, $default ) );
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string|null String including HTML tags for the header on error
	 */
	public function getHeader( string $widget = '',  string $uid = '' ) : ?string
	{
		$view = $this->getView();

		try
		{
			if( !isset( $this->view ) ) {
				$view = $this->view = $this->getObject()->addData( $view );
			}

			$html = '';
			foreach( $this->getSubClients() as $subclient ) {
				$html .= $subclient->setView( $view )->getHeader( $uid );
			}
			$view->widgetHeader = $html;
			if($widget) $widget = rtrim(ltrim($widget, '/'), '/').'/';
			
			$tplconf = 'client/html/swordbros/frigis/widget/template-header';
			$default = 'widget/'.$widget.'header-standard';

			return $view->render( $view->config( $tplconf, $default ) );
		}
		catch( \Exception $e )
		{
			$this->logException( $e );
		}

		return null;
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( string $type, string $name = null ) : \Aimeos\Client\Html\Iface
	{

		return $this->createSubClient( 'swordbros/widget/' . $type, $name );
	}


	/**
	 * Processes the input, e.g. store given values.
	 *
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables if necessary.
	 */
	public function process()
	{
		$context = $this->getContext();
		$view = $this->getView();

		try
		{
			parent::process();
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
		}
		catch( \Aimeos\Controller\Frontend\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
		}
		catch( \Aimeos\Client\Html\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
		}
		catch( \Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
			$view->widgetErrorList = array_merge( $view->get( 'widgetErrorList', [] ), $error );
			$this->logException( $e );
		}
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames() : array
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}


	/**
	 * Sets the necessary parameter values in the view.
	 *
	 * @param \Aimeos\MW\View\Iface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return \Aimeos\MW\View\Iface Modified view object
	 */
	public function addData( \Aimeos\MW\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\MW\View\Iface
	{
		$context = $this->getContext();
		$locale = $context->getLocale();
		$view->selectLanguageId = $locale->getLanguageId();
		$view->selectCurrencyId = $locale->getCurrencyId();
		$domains = $context->getConfig()->get( 'client/html/swordbros/widget/domains', [] );

		$cntl = \Aimeos\Controller\Frontend::create( $context, 'widget' );
		$view->widgetCustomerItem = $cntl->uses( $domains )->get();
		if( in_array( 'navigator', $config->get( 'client/html/catalog/stage/standard/subparts', ['navigator'] ) ) )
		{
			$size = $config->get( 'client/html/catalog/lists/size', 48 );
			$size = min( max( $view->param( 'l_size', $size ), 1 ), 100 );
			$page = min( max( $view->param( 'l_page', 1 ), 1 ), 100 );

			$view->itemPosition = ( $page - 1 ) * $size;
		}


		return parent::addData( $view, $tags, $expire );
	}
	public function getContext() :  \Aimeos\MShop\Context\Item\Iface
	{
		return parent::getContext();
	}

}
