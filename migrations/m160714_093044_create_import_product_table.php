<?php

use yii\db\Migration;

/**
 * Handles the creation for table `import_product`.
 */
class m160714_093044_create_import_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('import_product', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer(),
            'remote_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'vendor_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull()->defaultValue(''),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'oldprice' => $this->integer()->notNull()->defaultValue(0),
            'url' => $this->string()->notNull()->defaultValue(''),
            'image' => $this->string()->notNull()->defaultValue(''),
            'stock' => $this->integer()->notNull(),
            'guarantee' => $this->string()->notNull()->defaultValue(''),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createIndex('idx-import_product-remote_id', 'import_product', 'remote_id');

        $this->addForeignKey('fk-import_product-user_id', 'import_product', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk-import_product-product_id', 'import_product', 'product_id', 'product', 'id', 'CASCADE');

        $this->addForeignKey('fk-import_product-category_id', 'import_product', 'category_id', 'import_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-import_product-vendor_id', 'import_product', 'vendor_id', 'import_vendor', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import_product-user_id', 'import_product');

        $this->dropForeignKey('fk-import_product-product_id', 'import_product');

        $this->dropForeignKey('fk-import_product-category_id', 'import_product');

        $this->dropForeignKey('fk-import_product-vendor_id', 'import_product');

        $this->dropTable('import_product');
    }
}
