<?php

class m160824_043637_photo extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `photo` ADD  `sizes` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `size`");
        $this->execute("ALTER TABLE  `photo` ADD  `subcategory` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `category`");
        $this->execute("ALTER TABLE  `photo` ADD  `color` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `sale`");
        $this->execute("UPDATE `photo` 
                        SET `sizes`= IF(`size`>0,
                            TRIM(BOTH ',' FROM 
                                 CONCAT(
                                IF(`size_40`>0,'40,',''),
                                IF(`size_42`>0,'42,',''),
                                IF(`size_44`>0,'44,',''),
                                IF(`size_46`>0,'46,',''),
                                IF(`size_48`>0,'48,',''),
                                IF(`size_50`>0,'50,',''),
                                IF(`size_52`>0,'52,',''),
                                IF(`size_54`>0,'54,','')
                            )
                                ), 
                            null)");
        $this->execute("UPDATE `photo` SET `color`= CASE RIGHT(`article`, 1) 
                            WHEN 0 THEN 'белый'
                            WHEN 1 THEN 'черный' 
                            WHEN 2 THEN 'серый'
                            WHEN 3 THEN 'желтый' 
                            WHEN 4 THEN 'красный'
                            WHEN 5 THEN 'розовый' 
                            WHEN 6 THEN 'фиолетовый'
                            WHEN 7 THEN 'синий' 
                            WHEN 8 THEN 'голубой'
                            WHEN 9 THEN 'зеленый' 
                        END");
        $this->execute("UPDATE `photo` SET `subcategory` = 'dress_es,dress_midi' where `category` = 'dress' AND `article` < 14000");
        $this->execute("UPDATE `photo` SET `subcategory` = 'blouse_es,blouse_ss' where `category` = 'blouse' AND `article` < 22000");
        $this->execute("UPDATE `photo` SET `subcategory` = 'kimono_silk,kimono_midi' where `category` = 'kimono' AND `article` < 45090");
        $this->execute("UPDATE `photo` SET `subcategory` = 'kimono_silk,kimono_mini' where `category` = 'kimono' AND `article` > 45090 AND `article` < 48000");
        $this->execute("UPDATE `photo` SET `subcategory` = 'kimono_cotton,kimono_midi' where `category` = 'kimono' AND `article` > 48000");
        $this->dropColumn('photo', 'size_40');
        $this->dropColumn('photo', 'size_42');
        $this->dropColumn('photo', 'size_44');
        $this->dropColumn('photo', 'size_46');
        $this->dropColumn('photo', 'size_48');
        $this->dropColumn('photo', 'size_50');
        $this->dropColumn('photo', 'size_52');
        $this->dropColumn('photo', 'size_54');
	}

	public function down()
	{
		echo "m160824_043637_photo does not support migration down.\n";
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