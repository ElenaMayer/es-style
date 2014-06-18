<?php

class m140615_013201_photo extends CDbMigration
{
	public function up()
	{
        $this->addColumn('photo', 'is_new', 'boolean');
        $this->addColumn('news', 'date_publish', 'date');
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