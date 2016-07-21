<?php

use yii\db\Migration;

/**
 * Handles the creation for table `import_product_param`.
 */
class m160714_093904_create_import_product_param_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('import_product_param', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->notNull()
        ]);

        $this->addForeignKey('fk-import_product_param-product_id', 'import_product_param', 'product_id', 'import_product', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import_product_param-product_id', 'import_product_param');

        $this->dropTable('import_product_param');
    }
}
