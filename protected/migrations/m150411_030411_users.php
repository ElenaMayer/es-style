<?php

class m150411_030411_users extends CDbMigration
{
	public function up()
	{
        $this->addColumn('user', 'name', 'string');
        $this->addColumn('user', 'surname', 'string');
        $this->addColumn('user', 'middlename', 'string');
        $this->addColumn('user', 'phone', 'string');
        $this->addColumn('user', 'address', 'string');
        $this->addColumn('user', 'postcode', 'int');
        $this->addColumn('user', 'email', 'string');
        $this->addColumn('user', 'date_of_birth', 'date');
        $this->addColumn('user', 'sex', 'string');
        $this->addColumn('user', 'is_subscribed', 'boolean');
	}

	public function down()
	{
		echo "m150411_030411_users does not support migration down.\n";
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