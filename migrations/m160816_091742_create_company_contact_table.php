<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_contact`.
 */
class m160816_091742_create_company_contact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_contact', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'address' => $this->string(),
            'email' => $this->string(),
            'phone1' => $this->string()->notNull(),
            'phone2' => $this->string(),
            'coordinate' => $this->string(),
        ]);

        $this->addForeignKey('fk-company_contact-compamy_id', 'company_contact', 'company_id', 'company', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-company_contact-compamy_id', 'company_contact');

        $this->dropTable('company_contact');
    }
}
