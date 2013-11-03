<?php
namespace Entry;

use Entry\Model\Entry;
use Entry\Model\EntryTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

	
	// Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Entry\Model\EntryTable' =>  function($sm) {
                    $tableGateway = $sm->get('EntryTableGateway');
                    $table = new EntryTable($tableGateway);
                    return $table;
                },
                'EntryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entry());
                    return new TableGateway('entry', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }



}
