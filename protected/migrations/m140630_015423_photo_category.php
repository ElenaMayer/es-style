<?php

class m140630_015423_photo_category extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('photo', 'category_id');
        $this->addColumn('photo', 'category', 'string');
	}

	public function down()
	{
		echo "m140630_015423_photo_category does not support migration down.\n";
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