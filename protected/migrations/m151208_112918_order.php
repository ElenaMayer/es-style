<?php

class m151208_112918_order extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order_history', 'track_code', 'string');
	}

	public function down()
	{
		echo "m151208_112918_order does not support migration down.\n";
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