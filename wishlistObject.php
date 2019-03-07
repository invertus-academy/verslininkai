<?php
/**
 * Created by PhpStorm.
 * User: Modestas
 * Date: 3/7/2019
 * Time: 2:22 PM
 */

class wishlistObject extends ObjectModel
{
    public $id_customer;

    public static $definition = array(
        'table' => 'wishlist',
        'primary' => 'id_wishlist',
        'fields' => array(
            'id_customer' =>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true))

    );


    public function addProduct($id_product)
    {

        return (Db::getInstance()->execute('
			INSERT INTO `'._DB_PREFIX_.'wishlist_product` (`id_product`, `id_wishlist`) VALUES(
			'.(int) ($id_product).',
			'.(int)($this->id).')'));
    }

    public function checkWishListExist($customer_id){
        return (bool)(Db::getInstance()->executeS(
            'SELECT COUNT(*) FROM `'._DB_PREFIX_.'wishlist` WHERE id_customer =   '.(int)$customer_id));
    }

}
