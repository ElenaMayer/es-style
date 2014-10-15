<?php

class m141015_131856_order_delivery extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order', 'delivery', 'string');
        $this->dropColumn('order', 'size');
	}

	public function down()
	{
		echo "m141015_131856_order_delivery does not support migration down.\n";
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