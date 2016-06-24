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
$userRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => 'Application/account[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Account',
            'action' => 'edit',
        ),
    ),
);
$documentRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/cong-van[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Document',
            'action' => 'index',
        ),
    ),
);

$documentUploadRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/cong-van/tai-len[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Document',
            'action' => 'upload',
        ),
    ),
);

$membersRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/don-vi-thanh-vien[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'members',
            'action' => 'index',
        ),
    ),
);
$shareholderRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/quan-he-co-dong[/]',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Category',
            'action' => 'index',
            'id' => SHAREHOLDER_CATEGORY_ID,
        ),
    ),
);
$shareholderChildRoute = array(
    'type' => 'Zend\Mvc\Router\Http\Segment',
    'options' => array(
        'route' => '/quan-he-co-dong/:alias-cateogry[/:page]',
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
$applicationRoute = array(
    'type' => 'Literal',
    'options' => array(
        'route' => '/application',
        'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Account',
            'action' => 'login'
        )
    ),
    'may_terminate' => true,
    'child_routes' => array(
        'default' => array(
            'type' => 'Segment',
            'options' => array(
                'route' => '/[:controller[/:action[/:id]]][/]',
                'constraints' => array(
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'id' => '[0-9]*',
                ),
                'defaults' => array(
                )
            )
        ),
        'paginator' => array(
            'type' => 'Segment',
            'options' => array(
                'route' => '/:controller/index[/:page][/]',
                'constraints' => array(
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'page' => '[0-9]*'
                ),
                'defaults' => array()
            )
        )
    )
);
//$userEditRoute = array(
//    'type' => 'Zend\Mvc\Router\Http\Segment',
//    'options' => array(
//        'route' => 'Application/user/edit[/]',
//        'defaults' => array(
//            '__NAMESPACE__' => 'Application\Controller',
//            'controller' => 'Account',
//            'action' => 'upload',
//        ),
//    ),
//);
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
            'document' => $documentRoute,
            'documentUpload' => $documentUploadRoute,
            'members' => $membersRoute,
            'shareholder' => $shareholderRoute,
            'shareholderChildRoute' => $shareholderChildRoute,
            'application' => $applicationRoute,
            'user' => $userRoute,
        ),
    )
);

