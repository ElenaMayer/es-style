<?php

class m161021_103622_comment_img extends CDbMigration
{
	public function up()
	{
        $this->addColumn('comment', 'img', 'string');
        $this->addColumn('comment', 'rating', 'int');
        $this->addColumn('comment', 'city', 'string');

        $this->createTable('coupon', array(
            'id' => 'pk',
            'coupon' => 'string',
            'sale' => 'int',
            'is_active' => 'boolean',
            'is_reusable' => 'boolean',
            'is_used' => 'boolean',
            'until_date' => 'date',
            'date_create' => 'datetime',
        ));

        $this->addColumn('user', 'coupon_id', 'int');
        $this->addForeignKey('FK_user_coupon_id', 'user', 'coupon_id', 'coupon', 'id', 'CASCADE', 'RESTRICT');

        $this->addColumn('cart', 'coupon_id', 'int');
        $this->addForeignKey('FK_cart_coupon_id', 'cart', 'coupon_id', 'coupon', 'id', 'CASCADE', 'RESTRICT');

        $this->addColumn('order_history', 'coupon_id', 'int');
        $this->addColumn('order_history', 'coupon_sale', 'int');

	}

	public function down()
	{
		echo "m161021_103622_comment_img does not support migration down.\n";
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