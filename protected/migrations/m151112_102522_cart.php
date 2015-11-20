<?php

class m151112_102522_cart extends CDbMigration
{
	public function up()
	{
        $this->createTable('cart', array(
            'id' => 'pk',
            'user_id' => 'int',
        ));
        $this->createTable('cart_item', array(
            'id' => 'pk',
            'cart_id' => 'int',
            'item_id' => 'int',
            'size' => 'int',
            'count' => 'int NOT NULL DEFAULT 1',
            'price' => 'int',
            'new_price' => 'int',
        ));
        $this->addForeignKey('FK_cart_user_id', 'cart', 'user_id', 'user', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('FK_cart_item_cart_id', 'cart_item', 'cart_id', 'cart', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('FK_cart_item_item_id', 'cart_item', 'item_id', 'photo', 'id', 'CASCADE', 'RESTRICT');
	}

	public function down()
	{
		$this->dropTable('cart');
        $this->dropTable('cart_item');
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