<?php

class m171101_065405_user_is_wholesaler extends CDbMigration
{
	public function up()
	{
	    $this->addColumn('user', 'is_wholesaler', 'boolean');
        $this->addColumn('user', 'tc', 'string');
        $this->addColumn('user', 'delivery_data', 'string');
        $this->addColumn('photo', 'wholesale_price', 'int');
        $this->addColumn('order_history', 'is_wholesale', 'boolean');
	}

	public function down()
	{
		echo "m171101_065405_user_is_wholesaler does not support migration down.\n";
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