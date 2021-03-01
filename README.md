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
## .htaccess
```
<IfModule mod_rewrite.c>
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```
## shop.php
```
	'client' => [
		'html' => [
			'checkout' => [
				'standard' => [
					'onepage' => ['address', 'delivery', 'payment', 'summary']
				]
			],
			'basket' => [
				'cache' => [
					 'enable' => false, // Disable basket content caching for development
				],
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
                            'location'=>'/home/paltoru3.tulparstudyo.net/public_html/public/jobs/products/xlsx/export',
                            'filename' => 'products-%1$d-'.date('Y-m-d-h-i-s').'.xlsx'
                        ]					
                    ],
                    'import' => [
                        'xlsx' => [
                           'domains'=>['attribute', 'media', 'price', 'product', 'text'] ,
                            'backup'=>'/home/paltoru3.tulparstudyo.net/public_html/public/jobs/products/xlsx/backup',
                            'location' => '/home/paltoru3.tulparstudyo.net/public_html/public/jobs/products/xlsx/import',
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
