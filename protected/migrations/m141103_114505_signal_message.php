<?php

class m141103_114505_signal_message extends CDbMigration
{
	public function up()
	{
    $this->createTable('{{message_signal}}', array(
      'message_id' => 'int(11) unsigned NOT NULL',
      'signal_id' => 'int(11) unsigned NOT NULL',
    ));
    $this->addPrimaryKey('pk_message_signal', '{{message_signal}}', 'message_id, signal_id');
    $this->addForeignKey('fk_message', '{{message_signal}}', 'message_id', '{{message}}', 'id');
    $this->addForeignKey('fk_signal', '{{message_signal}}', 'signal_id', '{{signal}}', 'id');
	}

	public function down()
	{
		echo "m141103_114505_signal_message does not support migration down.\n";
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