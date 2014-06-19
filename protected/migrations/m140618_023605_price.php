<?php

class m140618_023605_price extends CDbMigration
{
	public function up()
	{
        $this->createTable('price', array(
            'id' => 'pk',
            'file' => 'string',
            'date_create' => 'date',
        ));
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