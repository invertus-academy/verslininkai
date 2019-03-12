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

    public function showWishlistProducts($id_customer){
        $sql =
            'SELECT wlp.id, wl.id_customer, wl.id_wishlist, wlp.id_product, p.active, pl.name,
             GROUP_CONCAT(DISTINCT(cl.name) SEPARATOR ",") as categories,
             im.id_image as images, 
             p.price, p.id_tax_rules_group, p.wholesale_price, p.reference, 
             p.quantity, pl.description_short, pl.description, pl.link_rewrite, 
             p.available_for_order, p.date_add, p.show_price, p.online_only, p.condition
            FROM '._DB_PREFIX_.'wishlist_product wlp
            LEFT JOIN '._DB_PREFIX_.'wishlist wl ON (wlp.id_wishlist = wl.id_wishlist)
            LEFT JOIN '._DB_PREFIX_.'product p ON (wlp.id_product = p.id_product)
            LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (wlp.id_product = pl.id_product)
            LEFT JOIN '._DB_PREFIX_.'category_product cp ON (wlp.id_product = cp.id_product)
            LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cp.id_category = cl.id_category)
            LEFT JOIN '._DB_PREFIX_.'category c ON (cp.id_category = c.id_category)
            LEFT JOIN '._DB_PREFIX_.'product_tag pt ON (p.id_product = pt.id_product)
            LEFT JOIN '._DB_PREFIX_.'image im ON (im.id_product = p.id_product)
            WHERE wl.id_customer = '.(int)$id_customer.'
            GROUP BY wlp.id';

        return (Db::getInstance()->executeS($sql));
    }

    public function deleteProductFromWishlist($id, $id_customer){
        $id_wishlist = (int)Db::getInstance()->getValue('SELECT id_wishlist FROM '._DB_PREFIX_.'wishlist WHERE id_customer = '.$id_customer);
        return Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'wishlist_product WHERE id = '.$id.' AND id_wishlist =' .$id_wishlist);
    }

    public function deleteAllWishlist($id_customer){
        $id_wishlist = (int)Db::getInstance()->getValue('SELECT id_wishlist FROM '._DB_PREFIX_.'wishlist WHERE id_customer = '.$id_customer);
        return Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'wishlist_product WHERE id_wishlist =' .$id_wishlist);
    }
}
