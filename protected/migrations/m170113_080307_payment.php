<?php

class m170113_080307_payment extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order_history', 'total_with_commission', 'string');
        $this->addColumn('order_history', 'coupon_mail_flag', 'boolean');
	}

	public function down()
	{
		echo "m170113_080307_payment does not support migration down.\n";
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