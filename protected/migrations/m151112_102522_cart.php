<?php

class m151112_102522_cart extends CDbMigration
{
	public function up()
	{
        $this->createTable('cart', array(
            'id' => 'pk',
            'user_id' => 'int',
            'item_id' => 'int',
            'size' => 'int',
            'count' => 'int NOT NULL DEFAULT 1'
        ));
	}

	public function down()
	{
		echo "m151112_102522_cart does not support migration down.\n";
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