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
            'import_id' => $this->integer()->notNull(),
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

        $this->addForeignKey('fk-import_product-import_id', 'import_product', 'import_id', 'import', 'id', 'CASCADE');

        $this->addForeignKey('fk-import_product-category_id', 'import_product', 'category_id', 'import_category', 'category_id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import_product-import_id', 'import_product');

        $this->dropTable('import_product');
    }
}
