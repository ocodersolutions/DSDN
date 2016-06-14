<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Ocoder\Base\BaseActionController as OcoderActionController;

class IndexController extends OcoderActionController
{
    public function init() {
        
        // OPTIONS
        $this->_options['tableName'] = TABLE_CONFIGS;
        $this->_options['modelTable'] = 'Admin\Model\ConfigTable';
        $this->_options['formName'] = 'formAdminConfig';

        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity()) {
            $this->goAction('admin', array('controller' => 'account', 'action' => 'login'));
        }

        // DATA
        $this->_params['data'] = array_merge(
            $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );
    }
    
    public function indexAction()
    {
        $helperString = new \Ocoder\Helper\String;
        $configTableGateway = $this->getServiceLocator()->get('Admin\Model\ConfigTable');
        
        $myForm = $this->getForm();
        $task = 'add-item';
        $this->_params['data']['id'] = 1;

        $item = $configTableGateway->getItem($this->_params['data']);

        if (!empty($item)) {
            $titleLang = json_decode($item->title_lang);
            //$item->title_en = $titleLang->title_en;
            //$item->title_jp = $titleLang->title_jp;
            $descriptionLang = json_decode($item->description_lang);
            $item->description_en = stripslashes($descriptionLang->description_en);
            $item->description_jp = stripslashes($descriptionLang->description_jp);
            $keywordsLang = json_decode($item->keywords_lang);
            $item->keywords_en = $keywordsLang->keywords_en;
            $item->keywords_jp = $keywordsLang->keywords_jp;
            $company_nameLang = json_decode($item->company_name_lang);
            $item->company_name_en = $company_nameLang->company_name_en;
            $item->company_name_jp = $company_nameLang->company_name_jp;
            $company_descriptionLang = json_decode($item->company_description_lang);
            $item->company_description = stripslashes($item->company_description);
            $item->company_description_en = stripslashes($company_descriptionLang->company_description_en);
            $item->company_description_jp = stripslashes($company_descriptionLang->company_description_jp);
            $logoLang = json_decode($item->logo_lang);
            $item->logo_en = $logoLang->logo_en;
            $item->logo_jp = $logoLang->logo_jp;
            $intro_imageLang = json_decode($item->intro_image_lang);
            $item->intro_image_en = $intro_imageLang->intro_image_en;
            $item->intro_image_jp = $intro_imageLang->intro_image_jp;
            $contact_infoLang = json_decode($item->contact_info_lang);
            $item->contact_info = stripslashes($item->contact_info);
            $item->contact_info_en = stripslashes($contact_infoLang->contact_info_en);
            $item->contact_info_jp = stripslashes($contact_infoLang->contact_info_jp);
            $item->company_address = stripslashes($item->company_address);
            $item->company_phone = stripslashes($item->company_phone);
            $item->company_fax = stripslashes($item->company_fax);
            $item->company_email = stripslashes($item->company_email);
            $item->company_history = stripslashes($item->company_history);
            $item->company_business = stripslashes($item->company_business);

            $myForm->bind($item);
            $task = 'edit-item';
        }

        if ($this->getRequest()->isPost()) {
            $action = $this->_params['data']['action'];

            $titleEn = trim($this->_params['data']['title_en']) ? $this->_params['data']['title_en'] : $this->_params['data']['title'];
            $titleJp = trim($this->_params['data']['title_jp']) ? $this->_params['data']['title_jp'] : $this->_params['data']['title'];
            $this->_params['data']['title_lang'] = json_encode(
                    array(
                        'title_en' => $titleEn,
                        'title_jp' => $titleJp,
            ));
            unset($this->_params['data']['title_en']);
            unset($this->_params['data']['title_jp']);

            $this->_params['data']['description_lang'] = json_encode(
                    array(
                        'description_en' => trim($this->_params['data']['description_en']) ? $this->_params['data']['description_en'] : $this->_params['data']['description'],
                        'description_jp' => trim($this->_params['data']['description_jp']) ? $this->_params['data']['description_jp'] : $this->_params['data']['description'],
            ));
            unset($this->_params['data']['description_en']);
            unset($this->_params['data']['description_jp']);

            $this->_params['data']['keywords_lang'] = json_encode(
                    array(
                        'keywords_en' => trim($this->_params['data']['keywords_en']) ? $this->_params['data']['keywords_en'] : $this->_params['data']['keywords'],
                        'keywords_jp' => trim($this->_params['data']['keywords_jp']) ? $this->_params['data']['keywords_jp'] : $this->_params['data']['keywords'],
            ));
            unset($this->_params['data']['keywords_en']);
            unset($this->_params['data']['keywords_jp']);

            $this->_params['data']['company_name_lang'] = json_encode(
                    array(
                        'company_name_en' => trim($this->_params['data']['company_name_en']) ? $this->_params['data']['company_name_en'] : $this->_params['data']['company_name'],
                        'company_name_jp' => trim($this->_params['data']['company_name_jp']) ? $this->_params['data']['company_name_jp'] : $this->_params['data']['company_name'],
            ));
            unset($this->_params['data']['company_name_en']);
            unset($this->_params['data']['company_name_jp']);

            $this->_params['data']['company_description_lang'] = json_encode(
                    array(
                        'company_description_en' => trim($this->_params['data']['company_description_en']) ? $this->_params['data']['company_description_en'] : $this->_params['data']['company_description'],
                        'company_description_jp' => trim($this->_params['data']['company_description_jp']) ? $this->_params['data']['company_description_jp'] : $this->_params['data']['company_description'],
            ));
            unset($this->_params['data']['company_description_en']);
            unset($this->_params['data']['company_description_jp']);

            $this->_params['data']['logo_lang'] = json_encode(
                    array(
                        'logo_en' => trim($this->_params['data']['logo_en']) ? $this->_params['data']['logo_en'] : $this->_params['data']['logo'],
                        'logo_jp' => trim($this->_params['data']['logo_jp']) ? $this->_params['data']['logo_jp'] : $this->_params['data']['logo'],
            ));
            unset($this->_params['data']['logo_en']);
            unset($this->_params['data']['logo_jp']);

            $this->_params['data']['intro_image_lang'] = json_encode(
                    array(
                        'intro_image_en' => trim($this->_params['data']['intro_image_en']) ? $this->_params['data']['intro_image_en'] : $this->_params['data']['intro_image'],
                        'intro_image_jp' => trim($this->_params['data']['intro_image_jp']) ? $this->_params['data']['intro_image_jp'] : $this->_params['data']['intro_image'],
            ));
            unset($this->_params['data']['intro_image_en']);
            unset($this->_params['data']['intro_image_jp']);

            $this->_params['data']['contact_info_lang'] = json_encode(
                    array(
                        'contact_info_en' => trim($this->_params['data']['contact_info_en']) ? $this->_params['data']['contact_info_en'] : $this->_params['data']['contact_info'],
                        'contact_info_jp' => trim($this->_params['data']['contact_info_jp']) ? $this->_params['data']['contact_info_jp'] : $this->_params['data']['contact_info'],
            ));
            unset($this->_params['data']['contact_info_en']);
            unset($this->_params['data']['contact_info_jp']);
          
            unset($this->_params['data']['alias']);
            unset($this->_params['data']['action']);
            
           
            $id = $configTableGateway->saveItem($this->_params['data'], array('task' => $task));
            
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
            if ($action == 'save-close')
//                $this->goAction('admin', array('controller' => 'article'));
            if ($action == 'save-new')
                $this->goAction('admin');
            if ($action == 'save')
                $this->goAction('admin');
//            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
        ));
    }
}
