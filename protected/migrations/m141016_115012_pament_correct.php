<?php

class m141016_115012_pament_correct extends CDbMigration
{
	public function up()
	{
    $this->renameColumn('{{payment}}', 'currency_iso', 'currency');
    $this->addColumn('{{payment}}', 'description', 'string');
    $this->addColumn('{{payment}}', 'type', 'varchar(10)');
    $this->addColumn('{{payment}}', 'status', 'varchar(12)');
	}

	public function down()
	{
		echo "m141016_115012_pament_correct does not support migration down.\n";
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