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
        return parent::install() && $this->registerHook('displayHome'); //hook name from documentation hook list
    }

    public function hookDisplayHome(){
//        hooko atvaizdavimo funkcija
        return '<h1>Hello World</h1>';
    }
    //sveiki
}
