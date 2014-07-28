<?php

class m140702_130910_photo extends CDbMigration
{
	public function up()
	{
        $this->addColumn('photo', 'is_sale', 'boolean');
        $this->addColumn('photo', 'sale', 'string');
        $this->addColumn('photo', 'old_price', 'int');
        $this->addColumn('photo', 'new_price', 'int');
        $this->addColumn('photo', 'size', 'boolean');
        $this->addColumn('photo', 'uni_size', 'string');
        $this->addColumn('photo', 'size_40', 'boolean');
        $this->addColumn('photo', 'size_42', 'boolean');
        $this->addColumn('photo', 'size_44', 'boolean');
        $this->addColumn('photo', 'size_46', 'boolean');
        $this->addColumn('photo', 'size_48', 'boolean');
        $this->addColumn('photo', 'size_50', 'boolean');
        $this->addColumn('photo', 'size_52', 'boolean');
        $this->addColumn('photo', 'size_54', 'boolean');
	}

	public function down()
	{
		echo "m140702_130910_photo does not support migration down.\n";
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