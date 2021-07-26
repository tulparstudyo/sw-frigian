<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 * @package Client
 * @subpackage Html
 */

namespace Aimeos\Client\Html\Swordbros\HomeProducts;


/**
 * Default implementation of swordbros list section HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/swordbros/homeproducts/standard/subparts
	 * List of HTML sub-clients rendered within the swordbros list section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2014.03
	 * @category Developer
	 */
	private $subPartPath = 'client/html/swordbros/homeproducts/standard/subparts';

	/** client/html/swordbros/homeproducts/promo/name
	 * Name of the promotion part used by the swordbros list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Swordbros\HomeProducts\Promo\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/swordbros/homeproducts/items/name
	 * Name of the items part used by the swordbros list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Swordbros\HomeProducts\Items\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */
	private $subPartNames = array();

	private $tags = [];
	private $expire;
	private $view;


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( string $uid = '' ) : string
	{
		$prefixes = array( 'f', 'l' );
		$context = $this->getContext();

		$confkey = 'client/html/swordbros/homeproducts';

		if( ( $html = $this->getCached( 'body', $uid, $prefixes, $confkey ) ) === null )
		{
			$view = $this->getView();

			$tplconf = 'client/html//homeproducts/standard/template-body';
			$default = 'homeproducts/body-standard';

			try
			{
				if( !isset( $this->view ) ) {
					$view = $this->view = $this->getObject()->addData( $view, $this->tags, $this->expire );
				}

				$html = '';
				foreach( $this->getSubClients() as $subclient ) {
					$html .= $subclient->setView( $view )->getBody( $uid );
				}
				$view->listBody = $html;

				$html = $view->render( $this->getTemplatePath( $tplconf, $default ) );
				$this->setCached( 'body', $uid, $prefixes, $confkey, $html, $this->tags, $this->expire );

				return $html;
			}
			catch( \Aimeos\Client\Html\Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
				$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
			}
			catch( \Aimeos\Controller\Frontend\Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
				$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
			}
			catch( \Aimeos\MShop\Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
				$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
			}
			catch( \Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
				$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
				$this->logException( $e );
			}

			$html = $view->render( $this->getTemplatePath( $tplconf, $default ) );
		}
		else
		{
			$html = $this->modifyBody( $html, $uid );
		}

		return $html;
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string|null String including HTML tags for the header on error
	 */
	public function getHeader( string $uid = '' ) : ?string
	{
		$prefixes = array( 'f', 'l' );
		$confkey = 'client/html/swordbros/homeproducts';

		if( ( $html = $this->getCached( 'header', $uid, $prefixes, $confkey ) ) === null )
		{
			$view = $this->getView();

			$tplconf = 'client/html/homeproducts/standard/template-header';
			$default = 'homeproducts/header-standard';

			try
			{
				if( !isset( $this->view ) ) {
					$view = $this->view = $this->getObject()->addData( $view, $this->tags, $this->expire );
				}

				$html = '';
				foreach( $this->getSubClients() as $subclient ) {
					$html .= $subclient->setView( $view )->getHeader( $uid );
				}
				$view->listHeader = $html;

				$html = $view->render( $this->getTemplatePath( $tplconf, $default ) );
				$this->setCached( 'header', $uid, $prefixes, $confkey, $html, $this->tags, $this->expire );

				return $html;
			}
			catch( \Exception $e )
			{
				$this->logException( $e );
			}
		}
		else
		{
			$html = $this->modifyHeader( $html, $uid );
		}

		return $html;
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

		return $this->createSubClient( 'swordbros/homeproducts/' . $type, $name );
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
			$site = $context->getLocale()->getSiteItem()->getCode();
			$params = $this->getClientParams( $view->param() );

			$catId = $context->getConfig()->get( 'client/html/swordbros/homeproducts/catid-default' );

			if( ( $catId = $view->param( 'f_catid', $catId ) ) )
			{
				$params['f_name'] = $view->param( 'f_name' );
				$params['f_catid'] = $catId;
			}

			$context->getSession()->set( 'aimeos/swordbros/homeproducts/params/last/' . $site, $params );

			parent::process();
		}
		catch( \Aimeos\Client\Html\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
			$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
		}
		catch( \Aimeos\Controller\Frontend\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
		}
		catch( \Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
			$view->listErrorList = array_merge( $view->get( 'listErrorList', [] ), $error );
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
		$total = 0;
		$context = $this->getContext();
		$config = $context->getConfig();

		$domains = $config->get( 'client/html/swordbros/domains', ['media', 'price', 'text'] );

		$pages = $config->get( 'client/html/swordbros/homeproducts/pages', 100 );

        $size = $config->get( 'client/html/swordbros/homeproducts/size', 48 );
 
		$level = $config->get( 'client/html/swordbros/homeproducts/levels', \Aimeos\MW\Tree\Manager\Base::LEVEL_ONE );

		$catids = $view->param( 'f_catid', $config->get( 'client/html/swordbros/homeproducts/catid-default' ) );
        
		$catids = $catids != null && is_scalar( $catids ) ? explode( ',', $catids ) : $catids; // workaround for TYPO3

		$sort = $view->param( 'f_sort', $config->get( 'client/html/swordbros/homeproducts/sort', 'relevance' ) );
		$size = min( max( $view->param( 'l_size', $size ), 1 ), 100 );
		$page = min( max( $view->param( 'l_page', 1 ), 1 ), $pages );
		$category = $config->get( 'client/html/swordbros/homeproducts/category', '1' );
        $catalog_lists = [];

		$tree = \Aimeos\Controller\Frontend::create( $context, 'catalog' )->uses( $domains )
			->getTree( \Aimeos\Controller\Frontend\Catalog\Iface::LIST );
	
        foreach( frigian_catalog_list_types() as $catalog_list_type ){ 
            if(!frigian_option('show_'.$catalog_list_type->code.'_products')) continue;
            $products = \Aimeos\Controller\Frontend::create( $context, 'product' )
                ->sort( $sort )
                ->category( [$category] , $catalog_list_type->code )
                ->uses( $domains )
                ->slice( 0,8 )
                ->search();

            $list_link = route('aimeos_shop_list', [  'f_catid' => $category] ); 
            $catalog_lists[$catalog_list_type->code]=['label'=>$catalog_list_type->label, 'list_link'=>$list_link, 'listProductItems'=>$products];
        }
		// Delete cache when products are added or deleted even when in "tag-all" mode
		//$this->addMetaItems( $products, $expire, $tags, ['product'] );
		$view->catalog_lists = $catalog_lists;

		$view->listParams = $this->getClientParams( map( $view->param() )->toArray() );
		$view->homeTree = $tree;
		return parent::addData( $view, $tags, $expire );
	}
}
