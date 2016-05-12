<?php

class m160512_130057_utm extends CDbMigration
{
	public function up()
	{
		$this->createTable('utm', array(
			'id' => 'pk',
			'utm_source' => 'string',
			'utm_medium' => 'string',
			'utm_campaign' => 'string',
			'utm_term' => 'string',
			'utm_content' => 'string',
			'date_create' => 'datetime',
		));
	}

	public function down()
	{
		echo "m160512_130057_utm does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}