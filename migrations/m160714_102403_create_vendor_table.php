<?php

use yii\db\Migration;

/**
 * Handles the creation for table `vendor`.
 */
class m160714_102403_create_vendor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vendor', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vendor');
    }
}
