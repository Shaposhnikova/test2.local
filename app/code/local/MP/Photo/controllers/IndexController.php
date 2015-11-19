<?php

class MP_Photo_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

}
?>

        <p>
            <label>Выберите аватар. Изображение должно быть формата jpg, gif или png:<br></label>
            <input type="FILE" name="fupload">
        </p>











