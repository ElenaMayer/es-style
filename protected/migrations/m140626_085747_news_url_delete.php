<?php

class m140626_085747_news_url_delete extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('news', 'url');
	}

	public function down()
	{
		echo "m140626_085747_news_url_delete does not support migration down.\n";
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