<?php
return array(
		'doctrine' => array(
				'connection' => array(
						'orm_default' => array(
								'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
								'params' => array(
										'host'     => 'localhost',
										'port'     => '3306',
										'user'     => 'root',
										'password' => 'stimpy2305',
										'dbname'   => 'hashtagplus',
								)
						)
				)
		),
);