<?php

class m161021_103622_comment_img extends CDbMigration
{
	public function up()
	{
        $this->addColumn('comment', 'img', 'string');
        $this->addColumn('comment', 'rating', 'int');
        $this->addColumn('comment', 'city', 'string');
	}

	public function down()
	{
		echo "m161021_103622_comment_img does not support migration down.\n";
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