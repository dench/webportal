<?php

use yii\db\Migration;

/**
 * Handles the creation for table `parse_product`.
 */
class m160714_093044_create_parse_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parse_product', [
            'id' => $this->primaryKey(),
            'parse_id' => $this->integer()->notNull(),
            'remote_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull()->defaultValue(''),
            'vendor' => $this->string()->notNull()->defaultValue(''),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'oldprice' => $this->integer()->notNull()->defaultValue(0),
            'url' => $this->string()->notNull()->defaultValue(''),
            'image' => $this->string()->notNull()->defaultValue(''),
            'stock' => $this->string()->notNull()->defaultValue(''),
            'guarantee' => $this->string()->notNull()->defaultValue(''),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->addForeignKey('fk-parse_product-parse_id', 'parse_product', 'parse_id', 'parse', 'id', 'CASCADE');

        $this->addForeignKey('fk-parse_product-category_id', 'parse_product', 'category_id', 'parse_category', 'category_id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-parse_product-parse_id', 'parse_product');

        $this->dropTable('parse_product');
    }
}
