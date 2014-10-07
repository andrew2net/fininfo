<?php

class m141007_035324_trade_date_key extends CDbMigration
{
	public function up()
	{
    $this->dropPrimaryKey('pk_date', '{{trade_data}}');
    $this->addPrimaryKey('pk_type_date', '{{trade_data}}', 'date, subscription_type_id');
	}

	public function down()
	{
		echo "m141007_035324_trade_date_key does not support migration down.\n";
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