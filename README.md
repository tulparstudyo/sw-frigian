# Setup
```
    "require": {
        ...
        "tulparstudyo/sw-frigian": "^1.0"
    }

```
```
    "files": [
        ...
        "ext/sw-sardes/helper/theme_helper.php"
    ]
```
```
    "post-update-cmd": [
        ...
        "@php artisan migrate --path=ext/sw-frigian/lib/custom/setup/options",
        "Swordbros\\Sardes::composerUpdate"
    ]
```
## .env
```
please change your website .env file 
APP_URL:

```
## .htaccess
```
<IfModule mod_rewrite.c>
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```
## shop.php
```
	'page' => [
		// Docs: https://aimeos.org/docs/Laravel/Adapt_pages
		// Hint: catalog/filter is also available as single 'catalog/tree', 'catalog/search', 'catalog/attribute'
		'account-index' => [ 'account/profile','account/review','account/subscription','account/history','account/favorite','account/watch','basket/mini','catalog/session' ],
		'basket-index' => [ 'basket/mini','basket/bulk', 'basket/standard','basket/related' ],
		'catalog-count' => [ 'catalog/count' ],
		'catalog-detail' => [ 'basket/mini','catalog/stage','catalog/detail','catalog/session' ],
		'catalog-home' => [ 'basket/mini','catalog/home' ],
		'catalog-list' => [ 'basket/mini','catalog/filter','catalog/lists' ],
		'catalog-stock' => [ 'catalog/stock' ],
		'catalog-suggest' => [ 'catalog/suggest' ],
		'catalog-tree' => [ 'basket/mini','catalog/filter','catalog/stage','catalog/lists' ],
		'checkout-confirm' => [ 'checkout/confirm' ],
		'checkout-index' => [ 'basket/mini','checkout/standard' ],
		'checkout-update' => [ 'checkout/update' ],
	],
	'client' => [
		'html' => [
			'checkout' => [
				'standard' => [
					'onepage' => ['address', 'delivery', 'payment', 'summary']
				]
			],
			'common' => [

				'baseurl' =>  'packages/swordbros/shop/themes/frigian/' ,
				'template' => [
					'baseurl' => 'packages/swordbros/shop/themes/frigian',
				
				],
			],
	],
	'controller' => [
	    'common' => [
            'media' => [
                'standard' => [
                    'previews' => [
                        [
                            'maxwidth' => 300,
                            'maxheight' => 375,
                            'force-size' => 1,
                        ],
                        [
                            'maxwidth' => 600,
                            'maxheight' => 750,
                            'force-size' => 1,
                        ],
                        [
                            'maxwidth' => 1200,
                            'maxheight' => 1500,
                            'force-size' => 1,
                        ]
                    ],
                ],
            ],
            'product'=>[
                'import' => [
                    'xlsx' =>[
                        'processor' =>[
                            'media' => [
                                'listtypes'=>['default', 'standard']
                            ]
                        ]
                    ]
                ]
            ]
        ],
	'jobs' => [
            'product'=>[
                    'export' => [
                        'xlsx' => [
                            'location'=>'/your_site_path/public/jobs/products/xlsx/export',
                            'filename' => 'products-%1$d-'.date('Y-m-d-h-i-s').'.xlsx'
                        ]					
                    ],
                    'import' => [
                        'xlsx' => [
                           'domains'=>['attribute', 'media', 'price', 'product', 'text'] ,
                            'backup'=>'/your_site_path/public/jobs/products/xlsx/backup',
                            'location' => '/your_site_path/public/jobs/products/xlsx/import',
                            'skip-lines' => 0,
                            'map-items' => [
                                'media'=>[
                                    '8'=>'media.url',
                                    '21'=>'media.url',
                                ]
                            ]
                        ]					
                    ]
                ]
	     ]
	],

```
## Export & Import Product
```
Export command: php artisan aimeos:jobs "product/export/xlsx" "default"
Import Command php artisan aimeos:jobs "product/import/xlsx" "default"
```
