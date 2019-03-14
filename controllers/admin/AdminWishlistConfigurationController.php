<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019-03-05
 * Time: 18:29
 */

class AdminWishlistConfigurationController extends ModuleAdminController
{
    public function __construct()
    {

        $this->table = 'wishlist_product';
        $this->className = 'wishlist';
        $this->identifier = 'id';
        $this->identifier = 'id_wishlist';
        $this->lang = false;
        $this->list_no_link = true;
        $this->bootstrap = true;
        parent::__construct();
        $this->initList();

    }
//    public function init()
//    {
//        parent::init();
//    }
    public function initList()
    {
        $this->fields_list = array(
            'id' => array(
                'title' => $this->l('id'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'a!id',
            ),
            'id_wishlist' => array(
                'title' => $this->l('id_wishlist'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'a!id_wishlist',
            ),
            'id_product' => array(
                'title' => $this->l('id_product'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'a!id_product',
            ),
            'id_customer' => array(
                'title' => $this->l('id_customer'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'wl!id_customer',
            ),
            'name' => array(
                'title' => $this->l('p_name'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'p!name',
            ),
            'email' => array(
                'title' => $this->l('user_email'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'u!email',
            ),
        );
    }

    public function renderList()
    {
        $this->_select .= 'wl.id_customer, p.name, u.email';

        $this->_join .= '
           LEFT JOIN ' . _DB_PREFIX_ . 'wishlist wl
               ON a.id_wishlist = wl.id_wishlist
       ';
        $this->_join .= '
           LEFT JOIN ' . _DB_PREFIX_ . 'product_lang p
               ON p.id_product = a.id_product
       ';
        $this->_join .= '
           LEFT JOIN ' . _DB_PREFIX_ . 'customer u
               ON u.id_customer = wl.id_customer
       ';
        $this->_group .= 'GROUP BY a.id';

        return parent::renderList();

    }

}
