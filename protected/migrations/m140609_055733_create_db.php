<?php

class m140609_055733_create_db extends CDbMigration
{
	public function up()
	{
        $this->createTable('user', array(
            'id' => 'pk',
            'login' => 'string',
            'password' => 'string',
        ));
        $this->createTable('photo', array(
            'id' => 'pk',
            'img' => 'string',
            'category_id' => 'int',
            'article' => 'int',
            'price' => 'string',
            'title' => 'string',
            'description' => 'text',
            'is_show' => 'boolean',
            'date_create' => 'date',
        ));
        $this->createTable('news', array(
            'id' => 'pk',
            'url' => 'string',
            'title' => 'string',
            'content' => 'text',
            'is_show' => 'boolean',
            'date_create' => 'date',
        ));
        $this->createTable('order', array(
            'id' => 'pk',
            'type' => 'string',
            'name' => 'string',
            'first_name' => 'string',
            'second_name' => 'string',
            'middle_name' => 'string',
            'region' => 'string',
            'postcode' => 'int',
            'address' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'size' => 'string',
            'company' => 'string',
            'city' => 'string',
            'order' => 'text',
            'date_create' => 'date',
        ));

    }

	public function down()
	{
		echo "m140609_055733_create_db does not support migration down.\n";
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