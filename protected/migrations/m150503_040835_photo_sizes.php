<?php

class m150503_040835_photo_sizes extends CDbMigration
{
	public function up()
	{
        $this->addColumn('photo', 'size_at', 'int');
        $this->addColumn('photo', 'size_to', 'int');
        $this->execute("
            UPDATE photo
                SET
                    size_at = LEFT(uni_size, 2), size_to = RIGHT(uni_size, 2)
                WHERE size = 0
        ");
	}

	public function down()
	{
		echo "m150503_040835_photo_sizes does not support migration down.\n";
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