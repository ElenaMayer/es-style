<?php

class m151222_105340_photo_sale extends CDbMigration
{
	public function up()
	{
        $this->execute("
            UPDATE photo
                SET
                    old_price = price
                WHERE is_sale = 1
        ");
        $this->execute("
            UPDATE photo
                SET
                    price = new_price
                WHERE is_sale = 1
        ");
        $this->dropColumn('photo', 'uni_size');
        $this->addColumn('cart_item', 'date_create', 'datetime');
        $this->addColumn('user', 'date_create', 'datetime');
        $this->execute("
            UPDATE photo
                SET
                    sale = CAST(((old_price - price)*100/old_price) AS SIGNED)
                WHERE is_sale = 1
        ");
	}

	public function down()
	{
		echo "m151222_105340_photo_sale does not support migration down.\n";
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