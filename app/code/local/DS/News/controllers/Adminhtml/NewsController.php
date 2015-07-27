<?php

class DS_News_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        echo '<h1>News Module: Admin section</h1>';
    }


    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('news', null);

        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('dsnews/news')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d news have been deleted', sizeof($news)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select news'));
        }
        $this->_redirect('*/*');
    }

}