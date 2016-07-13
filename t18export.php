<?php
/**
  * T18 Export Module
  * @category export
  *
  * @author Vimpel - netdec.ru
  * @copyright Vimpel
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 0.5.0
  */
if (!defined('_PS_VERSION_'))
  exit;

class T18Export extends Module
{
	public function __construct()
	{
		$this->name = 't18export';
		$this->tab = 'export';
		$this->version = '0.5.0';
		$this->displayName = 'T18 Export Module';
		$this->author = 'Vimpel - netdec.ru';
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6');
		$this->description = $this->l('A module to export all data to csv matching the Prestashop import template.');
		parent::__construct();
	}

	public function install()
	{
		$this->installController('AdminT18Export', 'Export Data');
		return parent::install();

	}

	private function installController($controllerName, $name) {
		$tab_admin_order_id = Tab::getIdFromClassName('AdminTools');
        $tab = new Tab();
        $tab->class_name = $controllerName;
        $tab->id_parent = $tab_admin_order_id;
        $tab->module = $this->name;
        $languages = Language::getLanguages(false);
        foreach($languages as $lang){
            $tab->name[$lang['id_lang']] = $name;
        }
    	$tab->save();
	}

	public function uninstall()
	{
		$this->uninstallController('AdminT18Export');
		return parent::uninstall();
	}

	public function uninstallController($controllerName) {
		$tab_controller_main_id = TabCore::getIdFromClassName($controllerName);
		$tab_controller_main = new Tab($tab_controller_main_id);
		$tab_controller_main->delete();
	}

}
