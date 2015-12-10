<?php

class m151210_145842_order extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order_history', 'phone', 'string');
        $this->addColumn('order_history', 'email', 'string');
	}

	public function down()
	{
		echo "m151210_145842_order does not support migration down.\n";
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