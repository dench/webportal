<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_category`.
 */
class m160713_101304_create_product_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'slug' => $this->string(100)->unique(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'text' => $this->text(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(true)
        ]);

        $this->addForeignKey('fk-product_category-pid', 'product_category', 'parent_id', 'product_category', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-product_category-pid', 'product_category');

        $this->dropTable('product_category');
    }
}
