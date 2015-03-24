<?php

class m150324_061405_is_available extends CDbMigration
{
	public function up()
	{
        $this->addColumn('photo', 'is_available', 'boolean DEFAULT true');

	}

	public function down()
	{
		echo "m150324_061405_is_available does not support migration down.\n";
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