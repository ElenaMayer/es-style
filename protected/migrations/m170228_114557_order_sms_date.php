<?php

class m170228_114557_order_sms_date extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order_history', 'sms_date', 'date');

        $this->execute("
            UPDATE `order_history` 
            SET sms_date = NOW() 
            WHERE `status` = 'shipping_by_rp'
        ");
	}

	public function down()
	{
		echo "m170228_114557_order_sms_date does not support migration down.\n";
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