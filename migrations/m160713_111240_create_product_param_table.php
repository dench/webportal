<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_param`.
 */
class m160713_111240_create_product_param_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_param', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->notNull()
        ]);

        $this->addForeignKey('fk-product_param-product_id', 'product_param', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-product_param-product_id', 'product_param');

        $this->dropTable('product_param');
    }
}
