<?php

class m161017_062210_photo_zipcode extends CDbMigration
{
	public function up()
	{
        $this->addColumn('order_history', 'postcode', 'int');
        $this->execute("
            UPDATE order_history
                SET
                    postcode = SUBSTRING( address, 1, 6 ) 
        ");
        $this->execute("
            UPDATE order_history
                SET
                    address = SUBSTRING( address, 12 ) 
        ");
	}

	public function down()
	{
		echo "m161017_062210_photo_zipcode does not support migration down.\n";
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