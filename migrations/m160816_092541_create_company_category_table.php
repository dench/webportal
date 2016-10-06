<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_category`.
 */
class m160816_092541_create_company_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_category', [
            'company_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-company_category', 'company_category', ['company_id', 'category_id']);

        $this->addForeignKey('fk-company_category-company_id', 'company_category', 'company_id', 'company', 'id');

        $this->addForeignKey('fk-company_category-category_id', 'company_category', 'category_id', 'product_category', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-company_category-company_id', 'company_category');

        $this->dropForeignKey('fk-company_category-category_id', 'company_category');

        $this->dropTable('company_category');
    }
}
