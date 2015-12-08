<?php

class MP_Photo_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function preDispatch()
    {
        parent::preDispatch();
        $action = $this->getRequest()->getActionName();
        $loginUrl = Mage::helper('customer')->getLoginUrl();

        if (!Mage::getSingleton('customer/session')->authenticate($this, $loginUrl)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }
    }

    public function postAction()
    {
        $fileName = '';
        if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '')
        {
            try {
                $fileName = $_FILES['photo']['name'];
                $fileExt = strtolower(substr(strrchr($fileName, "."), 1));
                $fileNamewoe = rtrim($fileName, $fileExt);
                $uploader = new Varien_File_Uploader('photo');
                $uploader->setAllowedExtensions(array('doc', 'docx', 'pdf', 'jpg', 'jpeg', 'png', 'bmp', 'gif'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS . 'photos';
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $uploader->save($path . DS, $fileName);
            }
            catch (Exception $e)
            {
                echo $e;
                $error = true;
            }
            $url = Mage::getUrl('media/photos') . $fileName;
            $this->saveUrlToCustomersAttribute($url);
        }
        $this->_redirect('*/*/index');
    }

    public function saveUrlToCustomersAttribute($url)
    {
        if($url){
            if(Mage::getSingleton('customer/session')->isLoggedIn()) {
                $customer = Mage::getSingleton('customer/session');
                $customerModel = Mage::getModel('customer/customer')->load($customer->getId());
                $customerModel->setCustomerPhoto($url);
                try {
                    $customerModel->save();
                    print('Saved: '.$customerModel->getCustomerPhoto());
                } catch (Exception $ex) {
                    Mage::throwException($ex->getMessage());
                }
            }
        }
    }

}




















