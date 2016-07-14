<?php

use yii\db\Migration;

/**
 * Handles the creation for table `parse_product_param`.
 */
class m160714_093904_create_parse_product_param_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parse_product_param', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->notNull()
        ]);

        $this->addForeignKey('fk-parse_product_param-product_id', 'parse_product_param', 'product_id', 'parse_product', 'id', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-parse_product_param-product_id', 'parse_product_param');

        $this->dropTable('parse_product_param');
    }
}
