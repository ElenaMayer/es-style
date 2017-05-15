<?php

class m170504_011820_horoscope extends CDbMigration
{
	public function up()
	{
        $this->createTable('horoscope_sign_by_year', array(
            'id' => 'pk',
            'sign' => 'string',
            'desc' => 'text',
            'sex_female_desc' => 'text',
            'sex_male_desc' => 'text',
            'color_white_desc' => 'text',
            'color_red_desc' => 'text',
            'color_black_desc' => 'text',
            'color_green_desc' => 'text',
            'color_yellow_desc' => 'text',
        ));
        $this->createTable('horoscope_sign_by_month', array(
            'id' => 'pk',
            'sign' => 'string',
            'desc' => 'text',
            'sex_female_desc' => 'text',
            'sex_male_desc' => 'text',
        ));
        $this->createTable('horoscope_color_by_sign', array(
            'id' => 'pk',
            'sign' => 'string',
            'color' => 'string',
        ));
        $this->createTable('horoscope_model_by_color', array(
            'id' => 'pk',
            'model_id' => 'string',
            'color' => 'string',
            'is_in_pare' => 'boolean'
        ));
        $this->createTable('horoscope_year_and_month', array(
            'id' => 'pk',
            'sign_by_year' => 'string',
            'sign_by_month' => 'string',
            'desc' => 'text',
        ));
	}

	public function down()
	{
		echo "m170504_011820_horoscope does not support migration down.\n";
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