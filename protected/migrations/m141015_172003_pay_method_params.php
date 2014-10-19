<?php

class m141015_172003_pay_method_params extends CDbMigration
{
	public function up()
	{
    $this->addColumn('{{pay_method}}', 'shop_id', 'string');
    $this->dropColumn('{{pay_method}}', 'action_url');
	}

	public function down()
	{
		echo "m141015_172003_pay_method_params does not support migration down.\n";
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