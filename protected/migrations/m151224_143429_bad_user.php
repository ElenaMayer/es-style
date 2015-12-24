<?php

class m151224_143429_bad_user extends CDbMigration
{
	public function up()
	{
        $this->addColumn('user', 'blocked', 'boolean');
	}

	public function down()
	{
		echo "m151224_143429_bad_user does not support migration down.\n";
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