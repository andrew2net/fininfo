<?php

class m141014_102540_invoice_pay extends CDbMigration
{
	public function up()
	{
    $this->dropForeignKey('fk_payment_subscription', '{{payment}}');
    $this->renameColumn('{{payment}}', 'subscription_id', 'invoice_id');
    $this->addForeignKey('fk_payment_invoice', '{{payment}}', 'invoice_id', '{{invoice}}', 'id');
	}

	public function down()
	{
		echo "m141014_102540_invoice_pay does not support migration down.\n";
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