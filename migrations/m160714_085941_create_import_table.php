<?php

use yii\db\Migration;

/**
 * Handles the creation for table `import`.
 */
class m160714_085941_create_import_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('import', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'format_id' => $this->smallInteger()->notNull(),
            'date' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'rate' => $this->decimal(4,2)->defaultValue(1),
            'filename' => $this->string()->notNull(),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->addForeignKey('fk-import-user_id', 'import', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import-user_id', 'import');

        $this->dropTable('import');
    }
}
