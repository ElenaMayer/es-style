<?php

class m160214_125425_news_sand_mail extends CDbMigration
{
	public function up()
	{
        $this->addColumn('news', 'is_send_mail', 'boolean');
	}

	public function down()
	{
		echo "m160214_125425_news_sand_mail does not support migration down.\n";
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