<?php
/**
  * Export Module
  * @category export
  *
  * @author Vimpel - netdec.ru
  * @copyright Vimpel
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 0.5.0
  */

class t18ExportModule extends Module
{
	public function __construct()
	{
		$this->name = 't18exportmodule';
		$this->tab = 'export';
		$this->version = '0.5.0';
		$this->displayName = 'T18 Export Module';
		$this->author = 'Vimpel - netdec.ru';
		$this->description = $this->l('A module to export all products and all categories to csv matching the Prestashop import template.');

		parent::__construct();
	}

	public function install()
	{
		$this->installController('T18AdminExportModule', 'T18 Export Module');
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
		$this->uninstallController('T18AdminExportModule');
		return parent::uninstall();
	}

	public function uninstallController($controllerName) {
		$tab_controller_main_id = TabCore::getIdFromClassName($controllerName);
		$tab_controller_main = new Tab($tab_controller_main_id);
		$tab_controller_main->delete();
	}

}
