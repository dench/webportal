<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product`.
 */
class m160714_102650_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'import_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull()->defaultValue(''),
            'vendor_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'oldprice' => $this->integer()->notNull()->defaultValue(0),
            'stock' => $this->integer()->notNull()->defaultValue(0),
            'guarantee' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->addForeignKey('fk-product-import_id', 'product', 'import_id', 'import_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-product-user_id', 'product', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk-product-category_id', 'product', 'category_id', 'product_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-product-vendor_id', 'product', 'vendor_id', 'vendor', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-product-import_id', 'product');
        $this->dropForeignKey('fk-product-user_id', 'product');
        $this->dropForeignKey('fk-product-category_id', 'product');
        $this->dropForeignKey('fk-product-vendor_id', 'product');

        $this->dropTable('product');
    }
}
