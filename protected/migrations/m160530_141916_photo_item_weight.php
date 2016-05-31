<?php

class m160530_141916_photo_item_weight extends CDbMigration
{
	public function up()
	{
		$this->addColumn('photo', 'weight', 'int');
		$this->execute("
            UPDATE photo
                SET
                    weight = 300
                WHERE category = 'dress'
        ");
		$this->execute("
            UPDATE photo
                SET
                    weight = 200
                WHERE category = 'blouse'
        ");
		$this->execute("
            UPDATE photo
                SET
                    weight = 200
                WHERE category = 'kimono'
        ");
		$this->execute("
            UPDATE photo
                SET
                    weight = 200
                WHERE category = 'other'
        ");
	}

	public function down()
	{
		echo "m160530_141916_photo_item_weight does not support migration down.\n";
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