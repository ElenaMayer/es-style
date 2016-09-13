<?php

class m160901_074848_blog extends CDbMigration
{
	public function up()
	{
        $this->createTable('blog_post', array(
            'id' => 'pk',
            'url' => 'string',
            'title' => 'string',
            'img' => 'string',
            'description' => 'text',
            'content' => 'text',
            'tags' => 'string',
            'likeCount' => 'int',
            'is_show' => 'boolean',
            'date_create' => 'date',
        ));
        $this->createTable('blog_tag', array(
            'id' => 'pk',
            'name' => 'string',
            'frequency' => 'int',
        ));
	}

	public function down()
	{
		echo "m160901_074848_blog does not support migration down.\n";
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