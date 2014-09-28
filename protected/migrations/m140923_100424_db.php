<?php

class m140923_100424_db extends CDbMigration {

  public function up() {
    $this->createTable('{{subscription_type}}', array(
      'id' => 'int(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'portid' => 'int(4) UNSIGNED NOT NULL',
      'symid' => 'varchar(10) NOT NULL',
      'price' => 'decimal(10,2) NOT NULL',
    ));

    $this->createTable('{{signal}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'subscription_type_id' => 'int(4) UNSIGNED NOT NULL',
      'recom' => 'varchar(25) NOT NULL',
      'sigdate' => 'datetime NOT NULL',
      'price' => 'decimal(12,2) NOT NULL',
    ));
    $this->addForeignKey('fk_signal_type', '{{signal}}', 'subscription_type_id'
        , '{{subscription_type}}', 'id', 'RESTRICT');

    $this->createTable('{{subscription}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'uid' => 'int(11) NOT NULL',
      'subscription_type_id' => 'int(4) UNSIGNED NOT NULL',
      'start' => 'date',
      'end' => 'date',
    ));
    $this->addForeignKey('fk_subscription_user', '{{subscription}}', 'uid'
        , '{{users}}', 'id', 'RESTRICT');
    $this->addForeignKey('fk_subscription_type', '{{subscription}}', 'subscription_type_id'
        , '{{subscription_type}}', 'id', 'RESTRICT');

    $this->createTable('{{page}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'url' => 'string NOT NULL',
      'title' => 'string NOT NULL',
      'content' => 'text',
      'menu_show' => 'TINYINT UNSIGNED DEFAULT 0',
      'update_time' => 'timestamp',
    ));

    $this->createTable('{{pay_params}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'pay_method_id' => 'int(11) UNSIGNED NOT NULL',
      'name' => 'string',
      'value' => 'string',
    ));

    $this->createTable('{{pay_method}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'name' => 'string',
      'description' => 'text',
      'type_id' => 'tinyint',
      'sign_name' => 'string',
      'sign_key' => 'string',
      'action_url' => 'string',
    ));

    $this->addForeignKey('fk_params_payment', '{{pay_params}}', 'pay_method_id', '{{pay_method}}', 'id', 'CASCADE');

    $this->createTable('{{payment}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'subscription_id' => 'int(11) UNSIGNED NOT NULL',
      'operation_id' => 'varchar(30)',
      'amount' => 'decimal(12,2) UNSIGNED',
      'currency_iso' => 'VARCHAR(3)',
      'pay_system_id' => 'varchar(30)',
      'corr_acc' => 'varchar(30)',
      'time' => 'datetime',
    ));
    $this->addForeignKey('fk_payment_subscription', '{{payment}}', 'subscription_id'
        , '{{subscription}}', 'id', 'RESTRICT');

    $this->createTable('{{message}}', array(
      'id' => 'int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT',
      'uid' => 'int(11) NOT NULL',
      'type_id' => 'int(1) unsigned NOT NULL',
      'transport_id' => 'int(1) unsigned NOT NULL',
      'status_id' => 'int(1) unsigned NOT NULL',
      'made_time' => 'datetime NOT NULL',
      'sent_time' => 'datetime',
    ));
    $this->addForeignKey('fk_mail_user', '{{message}}', 'uid', '{{users}}', 'id', 'RESTRICT', 'CASCADE');
  }

  public function down() {
    echo "m140923_100424_db does not support migration down.\n";
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
