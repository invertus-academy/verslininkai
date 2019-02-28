<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019-02-26
 * Time: 18:26
 */

class wishlist extends Module
{
    public function __construct()
    {
        $this->name = 'wishlist';
        $this->author = 'PrestaShop';
        $this->tab = 'front_office_features';
        $this->version = '0.1';


        parent::__construct();

        $this->displayName = $this->l("WishList");
        $this->description = $this->l(
            'Adds a item to wishlist'
        );
    }

    public function install()
    {
        return parent::install() && $this->registerHook('displayNav2')
            && $this->registerHook('productActions')
            && $this->registerHook('actionFrontControllerSetMedia'); //hook name from documentation hook list
    }

    public function hookActionFrontControllerSetMedia(){
        $this->context->controller->addCSS($this->_path.'views/css/style.css', 'all');
    }

    public function hookDisplayNav2(){
//        hooko atvaizdavimo funkcija
        return $this->context->smarty->fetch('module:wishlist/views/templates/front/buttonNav.tpl');
    }

    public function hookProductActions(){
        return $this->context->smarty->fetch('module:wishlist/views/templates/front/addButton.tpl');
    }

}
