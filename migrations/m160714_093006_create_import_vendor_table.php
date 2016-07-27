<?php

use yii\db\Migration;

/**
 * Handles the creation for table `import_vendor`.
 */
class m160714_093006_create_import_vendor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('import_vendor', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'vendor_id' => $this->integer()
        ]);

        $this->addForeignKey('fk-import_vendor-vendor_id', 'import_vendor', 'vendor_id', 'vendor', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import_vendor-vendor_id', 'import_vendor');

        $this->dropTable('import_vendor');
    }
}
