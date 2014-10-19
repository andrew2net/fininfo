<?php

class m141012_161702_invoice_table extends CDbMigration {

  public function up() {
    $this->createTable('{{invoice}}', array(
      'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'uid' => 'int(11) NOT NULL',
      'date' => 'datetime NOT NULL',
    ));
    $this->addForeignKey('fk_invoice_user', '{{invoice}}', 'uid'
        , '{{users}}', 'id', 'RESTRICT');


    $this->createTable('{{invoice_subscription}}', array(
      'invoice_id' => 'int(11) UNSIGNED',
      'subscription_type_id' => 'int(4) UNSIGNED NOT NULL',
      'start' => 'date',
      'months' => 'int(2)',
      'price' => 'decimal(10,2) NOT NULL',
    ));
    $this->addPrimaryKey('pk_invoice_subscription', '{{invoice_subscription}}'
        , 'invoice_id, subscription_type_id');
    $this->addForeignKey('fk_invoice_subscription_type', '{{invoice_subscription}}'
        , 'subscription_type_id', '{{subscription_type}}', 'id', 'RESTRICT');
    $this->addForeignKey('fk_invoice_subscription', '{{invoice_subscription}}'
        , 'invoice_id', '{{invoice}}', 'id', 'RESTRICT');
  }

  public function down() {
    echo "m141012_161702_invoice_table does not support migration down.\n";
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
