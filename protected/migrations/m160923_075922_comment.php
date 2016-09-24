<?php

class m160923_075922_comment extends CDbMigration
{
	public function up()
	{
        $this->createTable('comment', array(
            'id' => 'pk',
            'user_id' => 'int',
            'name' => 'string',
            'comment' => 'string',
            'type' => 'string',
            'item_id' => 'int',
            'is_show' => 'boolean',
            'date_create' => 'datetime',
        ));
	}

	public function down()
	{
		echo "m160923_075922_comment does not support migration down.\n";
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