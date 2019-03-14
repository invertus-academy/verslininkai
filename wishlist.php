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
            && $this->registerHook('displayReassurance')
            && $this->registerHook('actionFrontControllerSetMedia')
            && $this->registerHook('displayHome')
            && $this->createTable(); //hook name from documentation hook list

    }


//FRONT
    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/style.css', 'all');

    }

    public function hookDisplayNav2()
    {
//        hooko atvaizdavimo funkcija
        return $this->context->smarty->fetch('module:wishlist/views/templates/front/hooks/buttonNav.tpl');
    }


    public function hookDisplayReassurance()
    {
        $link = $this->context->link->getModuleLink('wishlist', 'wishlist', [
            'product_id' => Tools::getValue('id_product')
        ]);
        $this->context->smarty->assign('wishlistURL', $link);

        return $this->context->smarty->fetch('module:wishlist/views/templates/front/hooks/addButton.tpl');
    }

//BACK
    protected function createTable()
    {
        $res = true;
        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wishlist` (
                `id_wishlist` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_customer` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wishlist`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wishlist_product` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_wishlist` int(10) unsigned NOT NULL,
                `id_product` int(10) unsigned NOT NULL,
                 PRIMARY KEY (`id`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');
        return $res;
    }

    public function getContent()
    {
        $controllerLink = Context::getContext()->link->getAdminLink('AdminWishlistConfiguration');

        Tools::redirectAdmin(($controllerLink));
    }


    public function getTabs()
    {
        return [
            [
                'name' => 'wishlish',
                'parent_class_name' => 'WishlistParentModulesSf',
                'class_name' => 'WishlistModuleParent',
                'visible' => false
            ],
            [
                'name' => 'tabas',
                'parent_class_name' => 'AdminWishlistParentController',
                'class_name' => 'AdminWishlistConfiguration'
            ]
        ];
    }

    public function uninstall($delete_params = true)
    {
        if (($delete_params && !$this->deleteTables()) || !parent::uninstall())
            return false;
        return true;
    }
    private function deleteTables()
    {
        return Db::getInstance()->execute(
            'DROP TABLE IF EXISTS
			`'._DB_PREFIX_.'wishlist`,
			`'._DB_PREFIX_.'wishlist_product`'
        );
    }




}
