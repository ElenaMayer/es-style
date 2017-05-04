<?php

class m170424_015937_order_comment extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order_history', 'comment', 'text');
        $this->createTable('subscription', array(
            'id' => 'pk',
            'email' => 'string',
            'date_create' => 'date',
        ));
        $this->addColumn('coupon', 'type', 'text');
        $this->addColumn('coupon', 'category', 'text');
        $this->execute("
            UPDATE `coupon` 
            SET `type` = 'percent' 
        ");
	}

	public function down()
	{
		echo "m170424_015937_order_comment does not support migration down.\n";
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