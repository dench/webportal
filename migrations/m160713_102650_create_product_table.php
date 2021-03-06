<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product`.
 */
class m160713_102650_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'slug' => $this->string(100)->unique(),
            'code' => $this->string()->notNull()->defaultValue(''),
            'vendor_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'oldprice' => $this->integer(),
            'stock_id' => $this->integer()->notNull()->defaultValue(0),
            'guarantee' => $this->string(),
            'enabled' => $this->boolean()->notNull()->defaultValue(true)
        ]);

        $this->addForeignKey('fk-product-user_id', 'product', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk-product-category_id', 'product', 'category_id', 'product_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-product-vendor_id', 'product', 'vendor_id', 'vendor', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-product-user_id', 'product');

        $this->dropForeignKey('fk-product-category_id', 'product');

        $this->dropForeignKey('fk-product-vendor_id', 'product');

        $this->dropTable('product');
    }
}
