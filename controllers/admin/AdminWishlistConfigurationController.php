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
        $this->table = 'wishlist';
        $this->className = 'wishlist';
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
            'id_wishlist' => array(
                'title' => $this->l('Name'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'a!id_wishlist',
            ),
            'id_customer' => array(
                'title' => $this->l('Name'),
                'type' => 'text',
                'align' => 'center',
                'filter_key' => 'a!id_customer',
            ),
        );

    }
//    public function renderList()
//    {
//        $this->_select .= 'o.order_id, cl.name AS orderId';
//
//        $this->_join = '
//           LEFT JOIN '._DB_PREFIX_.'orders o
//               ON o.id_order = a.id_order
//       ';
//
//        return parent::renderList();
//    }
}
