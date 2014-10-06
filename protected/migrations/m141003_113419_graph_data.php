<?php

class m141003_113419_graph_data extends CDbMigration
{
	public function up()
	{
    $this->createTable('{{trade_data}}', array(
//      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'subscription_type_id' => 'int(4) UNSIGNED NOT NULL',
      'date' => 'date NOT NULL PRIMARY KEY',
      'profit' => 'decimal(12,2) NOT NULL'
    ));
    $this->addForeignKey('fk_td_type', '{{trade_data}}', 'subscription_type_id', '{{subscription_type}}', 'id', 'RESTRICT');
	}

	public function down()
	{
		echo "m141003_113419_graph_data does not support migration down.\n";
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