<?php

class m141016_181710_invoice_subscr_end extends CDbMigration
{
	public function up()
	{
    $this->addColumn('{{invoice_subscription}}', 'end', 'date');
	}

	public function down()
	{
		echo "m141016_181710_invoice_subscr_end does not support migration down.\n";
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