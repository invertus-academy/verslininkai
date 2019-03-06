<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019-03-01
 * Time: 14:09
 */

class WishlistWishlistModuleFrontController extends ModuleFrontController
{
    public $auth = true;


    public function __construct()
    {
        parent::__construct();
        $this->authRedirection =  $this->context->link->getModuleLink('wishlist', 'wishlist');
    }

    public function init(){
        $this->page_name = 'wishlist';

        parent::init();
    }

    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:wishlist/views/templates/front/test.tpl');
        $this->context->link->getModuleLink('wishlist', 'wishlist');

//        if (!$this->context->customer->isLogged() && $this->php_self != 'authentication' && $this->php_self != 'password') {
//
//            Tools::redirect('index.php?controller=authentication?back=my-account');
//        }

    }

    public function test(){
        $wishlist_id = 1; //get from database

        $wishlist = new Wishlist($wishlist_id);

        $product_id = 1; //get from post

        $wishlist->addProduct($product_id);
    }
}
