<?php

class m160217_102210_mail_log extends CDbMigration
{
	public function up()
	{
        $this->createTable('mail_log', array(
            'id' => 'pk',
            'email' => 'string',
            'action' => 'string',
            'send_date' => 'date',
        ));
	}

	public function down()
	{
		echo "m160217_102210_mail_log does not support migration down.\n";
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