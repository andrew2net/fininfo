<?php

class m141020_182405_chart_table extends CDbMigration
{
	public function up()
	{
//    $this->dropTable('{{cart}}');
    $this->dropTable('{{subscription}}');
    
    $this->createTable('{{chart}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'subscription_type_id' => 'int(4) UNSIGNED NOT NULL',
      'start' => 'date',
      'end' => 'date',
      'active' => 'boolean',
    ));
    $this->addForeignKey('fk_chart_subscription_type', '{{chart}}'
        , 'subscription_type_id', '{{subscription_type}}', 'id', 'RESTRICT');
	}

	public function down()
	{
		echo "m141020_182405_chart_table does not support migration down.\n";
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