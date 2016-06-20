<?php
define('PATH_APPLICATION', realpath(dirname(__DIR__)));
define('PATH_LIBRARY', PATH_APPLICATION . '/library');
define('PATH_VENDOR', PATH_APPLICATION . '/vendor');
define('PATH_ZEND_CORE', PATH_VENDOR . '/zendframework/zendframework/library');
define('PATH_PUBLIC', PATH_APPLICATION . '/public');
define('PATH_TEMPLATE', PATH_PUBLIC . '/templates');
define('PATH_PUBLIC_AVATAR', PATH_PUBLIC . '/uploads/avatar');
define('PATH_PUBLIC_DOCUMENTS', PATH_PUBLIC . '/uploads/documents');

define('URL_PUBLIC', URL_APPLICATION . '/public');
define('URL_TEMPLATE', URL_PUBLIC . '/templates');
define('URL_UPLOADS', URL_PUBLIC . '/uploads');
define('URL_UPLOADS_AVATAR', URL_PUBLIC . '/uploads/avatar');
define('URL_UPLOADS_DOCUMENTS', URL_PUBLIC . '/uploads/documents');

define('TABLE_USERS', 'users');
define('TABLE_PRODUCTCATEGORIES', 'productcategories');
define('TABLE_PRODUCTS', 'products');
define('TABLE_CATEGORIES', 'categories');
define('TABLE_ARTICLES', 'articles');
define('TABLE_CONFIGS', 'configs');
define('TABLE_CAREERS', 'careers');
define('TABLE_PARTNERS', 'partners');
define('TABLE_BANNERS', 'banners');
define('TABLE_TRAFIC', 'traffic');
define('TABLE_DOCUMENTS', 'documents');




