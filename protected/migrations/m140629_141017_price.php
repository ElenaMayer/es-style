<?php

class m140629_141017_price extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('photo', 'price');
        $this->addColumn('photo', 'price', 'int');
	}

	public function down()
	{
		echo "m140629_141017_price does not support migration down.\n";
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