<?php
namespace common;
class controller extends \Yaf\Controller_Abstract{
    protected $db;
    protected $config;
    function init()
    {
        $this->config = \Yaf\Registry::get('config');
        $this->db = \Yaf\Registry::get('db');
    }

    public function _assign($name,$vaule)
    {
        $this->getView()->assign($name,$vaule);
    }
    protected function display($tpl, array $parameters = null)
    {
        parent::display($tpl, $parameters); // TODO: Change the autogenerated stub
    }

    public function _display($tpl = '',array $parameters = null)
    {
        if(!$tpl)
        {
            $tpl = "{$this->getRequest()->controller}/{$this->getRequest()->action}.html";
        }
        $this->getView()->display($tpl,$parameters);
    }

}