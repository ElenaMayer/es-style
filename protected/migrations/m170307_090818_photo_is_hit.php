<?php

class m170307_090818_photo_is_hit extends CDbMigration
{
	public function up()
	{
        $this->addColumn('photo', 'is_hit', 'boolean');
	}

	public function down()
	{
		echo "m170307_090818_photo_is_hit does not support migration down.\n";
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