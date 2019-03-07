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
    public $id_product;

    public static $definition = array(
        'table' => 'wishlist',
        'primary' => 'id_wishlist',
        'fields' => array(
            'id_customer' =>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'id_product' =>    array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true))

    );


    public function addProduct($id_product, $id_customer)
    {
        return (Db::getInstance()->execute('
			INSERT INTO `'._DB_PREFIX_.'wishlist_product` (`id_product`, `id_customer`) VALUES(
			'.(int) ($id_customer).'
			'.(int)($id_product).')'));
    }
}