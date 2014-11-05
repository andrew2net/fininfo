<?php

class m141105_060902_params_table extends CDbMigration
{
	public function up()
	{
    $this->createTable('{{params}}', array(
      'id' => 'VARCHAR(12) NOT NULL PRIMARY KEY',
      'weight' => 'int',
      'name' => 'string',
      'value' => 'string',
    ));
    $this->insert('{{params}}', array(
      'id' => 'SmsMaxPrice',
      'weight' => 20,
      'name' => 'Максимальная стоимость SMS (руб.)',
      ));
    $this->insert('{{params}}', array(
      'id' => 'SmsGateApiId',
      'weight' => 21,
      'name' => 'SMS шлюз API ID',
      ));
	}

	public function down()
	{
		echo "m141105_060902_params_table does not support migration down.\n";
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