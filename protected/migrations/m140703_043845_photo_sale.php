<?php

class m140703_043845_photo_sale extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('photo', 'sale');
        $this->dropColumn('order', 'first_name');
        $this->dropColumn('order', 'second_name');
        $this->dropColumn('order', 'middle_name');
        $this->dropColumn('order', 'region');
	}

	public function down()
	{
		echo "m140703_043845_photo_sale does not support migration down.\n";
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