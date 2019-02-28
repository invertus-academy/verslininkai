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
        return parent::install() && $this->registerHook('displayHome') && $this->createTable(); //hook name from documentation hook list



    }

    public function hookDisplayHome(){
//        hooko atvaizdavimo funkcija
        return '<h1>Hello World</h1>';
    }

    protected function createTable()
    {
        $res = true;
        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'wishlist` (
                `id_wishlist` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_customer` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wishlist`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');

        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'wishlist_product` (
                `id_wishlist` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_product` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wishlist`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');
        return $res;

    }
}
