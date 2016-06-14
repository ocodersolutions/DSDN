<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Block\Admin\BlkTopUserInfo;
use Block\Admin\BlkLeftUserInfo;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return array_merge(
                include __DIR__ . '/config/module.config.php', include __DIR__ . '/config/router.config.php'
        );
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                /* FOR LOGIN AUTHENTICATION */
                'AuthService' => function($sm) {
                    //My assumption, you've alredy set dbAdapter
                    //and has users table with columns : user_name and pass_word
                    //that password hashed with md5
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'users', 'username', 'password', 'MD5(?)');

                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);

                    return $authService;
                },
                'UserTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\User());
                    return new TableGateway('users', $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\UserTable' => function ($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $myForm = new \Admin\Model\UserTable($tableGateway);
//                    $myForm->setInputFilter(new \Admin\Form\UserFilter());
                    return $myForm;
                },
                'ProductCategoryTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\ProductCategory());
                    return new TableGateway(TABLE_PRODUCTCATEGORIES, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\ProductCategoryTable' => function ($sm) {
                    $tableGateway = $sm->get('ProductCategoryTableGateway');
                    return new \Admin\Model\ProductCategoryTable($tableGateway);
                },
                'ProductTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Product());
                    return new TableGateway(TABLE_PRODUCTS, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\ProductTable' => function ($sm) {
                    $tableGateway = $sm->get('ProductTableGateway');
                    return new \Admin\Model\ProductTable($tableGateway);
                },
                'ArticleTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Article());
                    return new TableGateway(TABLE_ARTICLES, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\ArticleTable' => function ($sm) {
                    $tableGateway = $sm->get('ArticleTableGateway');
                    return new \Admin\Model\ArticleTable($tableGateway);
                },
                'CategoryTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Category());
                    return new TableGateway(TABLE_CATEGORIES, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\CategoryTable' => function ($sm) {
                    $tableGateway = $sm->get('CategoryTableGateway');
                    return new \Admin\Model\CategoryTable($tableGateway);
                },
                'ConfigTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Config());
                    return new TableGateway(TABLE_CONFIGS, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\ConfigTable' => function ($sm) {
                    $tableGateway = $sm->get('ConfigTableGateway');
                    return new \Admin\Model\ConfigTable($tableGateway);
                },
                'PartnerTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Partner());
                    return new TableGateway(TABLE_PARTNERS, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\PartnerTable' => function ($sm) {
                    $tableGateway = $sm->get('PartnerTableGateway');
                    return new \Admin\Model\PartnerTable($tableGateway);
                },
                'BannerTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Banner());
                    return new TableGateway(TABLE_BANNERS, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\BannerTable' => function ($sm) {
                    $tableGateway = $sm->get('BannerTableGateway');
                    return new \Admin\Model\BannerTable($tableGateway);
                },
                'TrafficTableGateway' => function ($sm) {
                    $adapter = $sm->get('dbConfig');
                    $resultSetPrototype = new HydratingResultSet();
                    $resultSetPrototype->setHydrator(new ObjectProperty());
                    $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Traffic());
                    return new TableGateway(TABLE_TRAFIC, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\TrafficTable' => function ($sm) {
                    $tableGateway = $sm->get('TrafficTableGateway');
                    return new \Admin\Model\TrafficTable($tableGateway);
                },
                'DocumentTableGateway'  => function ($sm) {
                        $adapter = $sm->get('dbConfig');
                        $resultSetPrototype = new HydratingResultSet();
                        $resultSetPrototype->setHydrator(new ObjectProperty());
                        $resultSetPrototype->setObjectPrototype(new \Admin\Model\Entity\Document());
                        return new TableGateway(TABLE_DOCUMENTS, $adapter, null, $resultSetPrototype);
                },
                'Admin\Model\DocumentTable' => function ($sm) {
                        $tableGateway   = $sm->get('DocumentTableGateway');
                        return new \Admin\Model\DocumentTable($tableGateway);
                }
            ),
        );
    }

    public function getFormElementConfig() {
        return array(
            'factories' => array(
                'formAdminUser' => function($sm) {
                    $myForm = new \Admin\Form\User();
//                    $myForm->setInputFilter(new \Admin\Form\UserFilter());
                    return $myForm;
                },
                'formAdminLogin' => function($sm) {
                    $myForm = new \Admin\Form\Login();
                    return $myForm;
                },
                'formAdminProductCategory' => function($sm) {
                    $categoryTable = $sm->getServiceLocator()->get('Admin\Model\ProductCategoryTable');
                    $myForm = new \Admin\Form\ProductCategory($categoryTable);
                    return $myForm;
                },
                'formAdminProduct' => function($sm) {
                    $categoryTable = $sm->getServiceLocator()->get('Admin\Model\ProductCategoryTable');
                    $myForm = new \Admin\Form\Product($categoryTable);
//                    $myForm->setInputFilter(new \Admin\Form\BookFilter());
                    return $myForm;
                },
                'formAdminCategory' => function($sm) {
                    $myForm = new \Admin\Form\Category();
                    return $myForm;
                },
                'formAdminArticle' => function($sm) {
                    $myForm = new \Admin\Form\Article();
//                    $myForm->setInputFilter(new \Admin\Form\BookFilter());
                    return $myForm;
                },
                'formAdminConfig' => function($sm) {
                    $myForm = new \Admin\Form\Config();
                    //                    $myForm->setInputFilter(new \Admin\Form\BookFilter());
                    return $myForm;
                },
                'formAdminPartner' => function($sm) {
                    $myForm = new \Admin\Form\Partner();
                    //                    $myForm->setInputFilter(new \Admin\Form\BookFilter());
                    return $myForm;
                },
                'formAdminBanner' => function($sm) {
                    $myForm = new \Admin\Form\Banner();
                    //                    $myForm->setInputFilter(new \Admin\Form\BookFilter());
                    return $myForm;
                },
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'cmsLinkSort' => '\Ocoder\View\Helper\CmsLinkSort',
                'cmsInfoUser' => '\Ocoder\View\Helper\CmsInfoUser',
                'cmsInfoAuthor' => '\Ocoder\View\Helper\CmsInfoAuthor',
                'cmsLinkAdmin' => '\Ocoder\View\Helper\CmsLinkAdmin',
                'CmsButtonPublished' => '\Ocoder\View\Helper\CmsButtonPublished',
                'cmsButtonSpecial' => '\Ocoder\View\Helper\CmsButtonSpecial',
                'cmsButtonToolbar' => '\Ocoder\View\Helper\CmsButtonToolbar',
                'ocoderFormHidden' => '\Ocoder\Form\View\Helper\FormHidden',
                'ocoderFormSelect' => '\Ocoder\Form\View\Helper\FormSelect',
                'ocoderFormInput' => '\Ocoder\Form\View\Helper\FormInput',
                'ocoderFormButton' => '\Ocoder\Form\View\Helper\FormButton',
            ),
            'factories' => array(
                'blkTopUserInfo' => function($sm) {
                    $helper = new BlkTopUserInfo();
                    $helper->setData($sm->getServiceLocator()->get('AuthService'));
                    return $helper;
                },
                'blkLeftUserInfo' => function($sm) {
                    $helper = new BlkLeftUserInfo();
                    $helper->setData($sm->getServiceLocator()->get('AuthService'));
                    return $helper;
                },
            ),
        );
    }

}
