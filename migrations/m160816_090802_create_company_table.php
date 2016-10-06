<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company`.
 */
class m160816_090802_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'domain' => $this->string(),
            'logo' => $this->string(),
            'name' => $this->string()->notNull(),
            'name_short' => $this->string()->notNull(),
            'description' => $this->string(),
            'text' => $this->string(),
            'website' => $this->string()
        ]);

        $this->addForeignKey('fk-company-user_id', 'company', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-company-user_id', 'company');

        $this->dropTable('company');
    }
}
