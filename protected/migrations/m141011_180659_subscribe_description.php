<?php

class m141011_180659_subscribe_description extends CDbMigration
{
	public function up()
	{
    $this->addColumn('{{subscription_type}}', 'description', 'text');
	}

	public function down()
	{
		echo "m141011_180659_subscribe_description does not support migration down.\n";
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