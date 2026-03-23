<?php

return [
	/**********************************************
	 * Emails Configuration for all Apps
	 **********************************************/

	'class' => \yii\symfonymailer\Mailer::class,
	'viewPath' => '@app/mail',
	// send all mails to a file by default. You have to set
	// 'useFileTransport' to false and configure transport
	// for the mailer to send real emails.
	'useFileTransport' => false,
	'transport' => [
		'scheme' => 'smtps',
		'encryption' => 'tls',
		'host' => 'mail.example.com',
		'port' => '587',
		'username' => 'equipamentos@example.com',
		'password' => 'password',
		'dsn' => 'sendmail://default',
	],

];
