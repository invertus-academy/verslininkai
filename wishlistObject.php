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
    public $id;
    public static $definition = array(
        'table' => 'wishlist',
        'primary' => 'id_wishlist',
        'fields' => array(
            'id_customer' =>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true))

    );


    public function addProduct($id_product, $id_customer)
    {
        $getCustomersID = (Db::getInstance()->getValue(
            'SELECT id_wishlist FROM `'._DB_PREFIX_.'wishlist` WHERE id_customer = '.(int)$id_customer));

        return (Db::getInstance()->execute('
			INSERT INTO `'._DB_PREFIX_.'wishlist_product` (`id_product`, `id_wishlist`) VALUES(
			'.(int) ($id_product).',
			'.(int)($getCustomersID).')'));

    }

    public function checkWishListExist($id_customer){
        return (bool)(Db::getInstance()->getValue(
            'SELECT COUNT(*) FROM `'._DB_PREFIX_.'wishlist` WHERE id_customer =   '.(int)$id_customer));
    }

}
