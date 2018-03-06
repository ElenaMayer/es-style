<?php

class m180306_064222_cart_item extends CDbMigration
{
	public function up()
	{
        $this->addColumn('cart_item', 'wholesale_price', 'int');
	}

	public function down()
	{
		echo "m180306_064222_cart_item does not support migration down.\n";
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