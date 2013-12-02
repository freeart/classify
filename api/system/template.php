<?php

class Template extends Api
{
    private $link;

    public function __construct()
    {
	    parent::__construct();

        require('../smarty/bin/Smarty.class.php');
        $this->link = new Smarty();

        $this->link->setTemplateDir('../templates');
        $this->link->setCompileDir('../smarty/templates_c');
        $this->link->setCacheDir('../smarty/cache');
        $this->link->setConfigDir('../smarty/configs');

	    $i18n = $this->i18n;

	    $this->link->registerPlugin("block", "t", array($i18n, 't'));
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array('Smarty::' . $method, $args);
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->link, $method), $args);
    }

}
