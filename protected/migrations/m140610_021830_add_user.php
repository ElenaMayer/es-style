<?php

class m140610_021830_add_user extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('user', 'login', 'username');
	}

	public function down()
	{
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