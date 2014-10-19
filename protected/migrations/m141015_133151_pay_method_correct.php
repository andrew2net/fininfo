<?php

class m141015_133151_pay_method_correct extends CDbMigration
{
	public function up()
	{
    $this->dropColumn('{{pay_method}}', 'sign_name');
    $this->addColumn('{{pay_method}}', 'active', 'boolean');
    $this->dropTable('{{pay_params}}');
	}

	public function down()
	{
		echo "m141015_133151_pay_method_correct does not support migration down.\n";
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