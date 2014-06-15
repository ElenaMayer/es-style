<?php

class m140615_013201_photo extends CDbMigration
{
	public function up()
	{
        $this->addColumn('photo', 'is_new', 'boolean');
	}

	public function down()
	{
		echo "m140615_013201_photo does not support migration down.\n";
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