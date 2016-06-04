<?php
// URL: /
// Admin\Controller\Index - indexAction
$homeRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Literal',
    'options' => array(
        'route' => '/',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'index'
        )
    )
);

$introCompanyRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/gioi-thieu[/:page]',
        'constraints' => array(
            'page' => '[1-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detail',
            'id' => COMPANY_INFO_CATEGORY_ID,
        ),
    ),
);
$introCompanyLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/introduction[/:page]',
        'constraints' => array(
            'page' => '[1-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detail',
            'id' => COMPANY_INFO_CATEGORY_ID,
        ),
    ),
);

$serviceRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/dich-vu[/:page]',
        'constraints' => array(
            'page' => '[1-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detail',
            'id' => SERVICE_CATEGORY_ID,
        ),
    ),
);
$serviceLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/services[/:page]',
        'constraints' => array(
            'page' => '[1-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detail',
            'id' => SERVICE_CATEGORY_ID,
        ),
    ),
);

$recruitmentRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/tuyen-dung[/:page]',
        'constraints' => array(
            'page' => '[1-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detail',
            'id' => RECRUITMENT_CATEGORY_ID,
        ),
    ),
);
$recruitmentLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/recruitment[/:page]',
        'constraints' => array(
            'page' => '[1-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detail',
            'id' => RECRUITMENT_CATEGORY_ID,
        ),
    ),
);

$newsRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/tin-tuc[/]',
        'constraints' => array(
            'alias-cateogry' => '[a-zA-Z0-9-_.]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'index',
            'id' => NEWS_CATEGORY_ID,
        ),
    ),
);
$newsLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/news[/]',
        'constraints' => array(
            'alias-cateogry' => '[a-zA-Z0-9-_.]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'index',
            'id' => NEWS_CATEGORY_ID,
        ),
    ),
);

$productsRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/san-pham[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Product',
            'action' => 'index',
        ),
    ),
);
$productsLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/products[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Product',
            'action' => 'index',
        ),
    ),
);
$googleVerificationRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/google46462e6475c9b871.html',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'google',
        ),
    ),
);
$productCategoryRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/san-pham/:alias-category[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Product',
            'action' => 'category',
        ),
    ),
);
$productCategoryLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/products/:alias-category[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Product',
            'action' => 'category',
        ),
    ),
);

$articleRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/bv/:alias',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'article',
        ),
    ),
);

$productRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/sp/:alias',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Product',
            'action' => 'product',
        ),
    ),
);

$categoryChildRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/tin-tuc/:alias-cateogry[/:page]',
        'constraints' => array(
            'alias-cateogry' => '[a-zA-Z0-9-_.]+',
            'page' => '[0-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detailChild',
        ),
    ),
);
$categoryChildLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/news/:alias-cateogry[/:page]',
        'constraints' => array(
            'alias-cateogry' => '[a-zA-Z0-9-_.]+',
            'page' => '[0-9]+',
        ),
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'detailChild',
        ),
    ),
);

$contactRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/lien-he[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'contact',
        ),
    ),
);
$contactLangRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/contact[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'contact',
        ),
    ),
);

$searchRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/tim-kiem[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'search',
        ),
    ),
);

return array(
    'router' => array(
        'routes' => array(
            'home' => $homeRoute,
            'news' => $newsRoute,
            'newsLang' => $newsLangRoute,
            'categoryChild' => $categoryChildRoute,
            'categoryChildLang' => $categoryChildLangRoute,
            'introCompany' => $introCompanyRoute,
            'introCompanyLang' => $introCompanyLangRoute,
            'service' => $serviceRoute,
            'serviceLang' => $serviceLangRoute,
            'recruitment' => $recruitmentRoute,
            'recruitmentLang' => $recruitmentLangRoute,
            'allCategories' => $productsRoute,
            'productLang' => $productsLangRoute,
            'article' => $articleRoute,
            'productCategory' => $productCategoryRoute,
            'productCategoryLang' => $productCategoryLangRoute,
            'product' => $productRoute,
            'contact' => $contactRoute,
            'contactLang' => $contactLangRoute,
            'search' => $searchRoute,
			'googleVerificationRoute' => $googleVerificationRoute,
        ),
    )
);

