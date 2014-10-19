<?php

class m141016_082856_inv_subscr_autorenew extends CDbMigration
{
	public function up()
	{
    $this->addColumn('{{invoice_subscription}}', 'autorenew', 'boolean');
	}

	public function down()
	{
		echo "m141016_082856_inv_subscr_autorenew does not support migration down.\n";
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