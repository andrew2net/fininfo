<?php

class m140927_062402_news extends CDbMigration
{
	public function up()
	{
    $this->createTable('{{news}}', array(
      'id' => 'int(11) unsigned not null auto_increment primary key',
      'date' => 'date',
      'header' => 'string',
      'text' => 'text',
      
    ));
	}

	public function down()
	{
		echo "m140927_062402_news does not support migration down.\n";
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