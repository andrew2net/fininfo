<?php

class m141016_123943_subscr_invoice extends CDbMigration
{
	public function up()
	{
    $this->addColumn('{{subscription}}', 'invoice_id', 'int(11) unsigned not null');
    $this->addForeignKey('fk_subscription_invoice', '{{subscription}}', 'invoice_id', '{{invoice}}', 'id', 'RESTRICT');
	}

	public function down()
	{
		echo "m141016_123943_subscr_invoice does not support migration down.\n";
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