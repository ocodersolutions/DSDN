<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach('dispatch', array($this, 'loadLayout'));
        $eventManager->attach('dispatch', array($this, 'loadLanguage'), 100);
        $eventManager->attach('dispatch', array($this, 'loadConfigs'), 99);
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

    public function loadLanguage(MvcEvent $e) {
        $ssSystem = new Container('system');
        $language = array_shift((explode(".", $_SERVER['HTTP_HOST'])));
        if ($language != null) {
            if ($language == 'en') {
                $ssSystem->offsetSet('language', 'en');
            } elseif ($language == 'jp') {
                $ssSystem->offsetSet('language', 'jp');
            } else {
                $ssSystem->offsetSet('language', DEFAULT_LANGUAGE);
            }
        }

        if ($ssSystem->offsetExists('language')) {
            include_once PATH_PUBLIC . '/languages/' . $ssSystem->offsetGet('language') . '.php';
        }

        define('URL_ALIAS_INTRO', $ssSystem->language == DEFAULT_LANGUAGE ? 'gioi-thieu' : 'introduction');
        define('URL_ALIAS_SERVICE', $ssSystem->language == DEFAULT_LANGUAGE ? 'dich-vu' : 'services');
        define('URL_ALIAS_NEWS', $ssSystem->language == DEFAULT_LANGUAGE ? 'tin-tuc' : 'news');
        define('URL_ALIAS_RECRUITMENT', $ssSystem->language == DEFAULT_LANGUAGE ? 'tuyen-dung' : 'recruitment');
        define('URL_ALIAS_PRODUCTS', $ssSystem->language == DEFAULT_LANGUAGE ? 'san-pham' : 'products');
        define('URL_ALIAS_CONTACT', $ssSystem->language == DEFAULT_LANGUAGE ? 'lien-he' : 'contact');
    }
    
    public function loadConfigs(MvcEvent $e){
        $sm = $e->getApplication()->getServiceManager();
        $configTable = $sm->get('Admin\Model\ConfigTable');
        
        $ssSystem = new Container('system');
        $params['id'] = 1;
        $configObj = $configTable->getItem($params);
        
        if ($ssSystem->language != DEFAULT_LANGUAGE) {
            $titleLang = json_decode($configObj->title_lang);
            $titleField = 'title_' . $ssSystem->language;
            $configObj->title = $titleLang->$titleField;
            
            $descriptionLang = json_decode($configObj->description_lang);
            $descriptionField = 'description_' . $ssSystem->language;
            $configObj->description = $descriptionLang->$descriptionField;
            
            $keywordsLang = json_decode($configObj->keywords_lang);
            $keywordsField = 'keywords_' . $ssSystem->language;
            $configObj->keywords = $keywordsLang->$keywordsField;
            
            $company_nameLang = json_decode($configObj->company_name_lang);
            $company_nameField = 'company_name_' . $ssSystem->language;
            $configObj->company_name = $company_nameLang->$company_nameField;
            
            $company_descriptionLang = json_decode($configObj->company_description_lang);
            $company_descriptionField = 'company_description_' . $ssSystem->language;
            $configObj->company_description = $company_descriptionLang->$company_descriptionField;
            
            $logoLang = json_decode($configObj->logo_lang);
            $logoField = 'logo_' . $ssSystem->language;
            $configObj->logo = $logoLang->$logoField;
            
            $intro_imageLang = json_decode($configObj->intro_image_lang);
            $intro_imageField = 'intro_image_' . $ssSystem->language;
            $configObj->intro_image = $intro_imageLang->$intro_imageField;
            
            $contact_infoLang = json_decode($configObj->contact_info_lang);
            $contact_infoField = 'contact_info_' . $ssSystem->language;
            $configObj->contact_info = $contact_infoLang->$contact_infoField;
        }
        
        $ssSystem->configs = $configObj; 
    }

    public function loadLayout(MvcEvent $e) {
        $routeMatch = $e->getRouteMatch();
        $controllerArr = explode('\\', $routeMatch->getParam('controller'));
        $moduleName = $controllerArr['0'];
        $config = $e->getApplication()->getServiceManager()->get('config');
        $controler = $e->getTarget();
        $controler->layout($config['module_layouts'][$moduleName]);
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'blkConfigs' => function($sm) {
                    $helper = new \Block\Frontend\BlkConfigs();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\ConfigTable'));
                    return $helper;
                },
                'blkLatestNews' => function($sm) {
                    $helper = new \Block\Frontend\BlkLatestNews();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\ArticleTable'));
                    return $helper;
                },
                'blkVideo' => function($sm) {
                    $helper = new \Block\Frontend\BlkVideo();
//                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\ArticleTable'));
                    return $helper;
                },
                'blkCareers' => function($sm) {
                    $helper = new \Block\Frontend\BlkCareers();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\ArticleTable'));
                    return $helper;
                },
                'blkNewsCategory' => function($sm) {
                    $helper = new \Block\Frontend\BlkNewsCategory();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\CategoryTable'));
                    return $helper;
                },   
                'blkServices' => function($sm) {
                    $helper = new \Block\Frontend\BlkServices();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\ArticleTable'));
                    return $helper;
                },     
                'blkProductCategory' => function($sm) {
                    $helper = new \Block\Frontend\BlkProductCategory();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\ProductCategoryTable'));
                    return $helper;
                },
                'blkPartners' => function($sm) {
                    $helper = new \Block\Frontend\BlkPartners();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\PartnerTable'));
                    return $helper;
                },
                'blkTrafic' => function($sm) {
                    $helper = new \Block\Frontend\BlkTrafic();
                    $helper->setData($sm->getServiceLocator()->get('Admin\Model\TrafficTable'));
                    return $helper;
                },
            ),
        );
    }

}
