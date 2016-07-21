<?php

use yii\db\Migration;

/**
 * Handles the creation for table `import_category`.
 */
class m160714_091839_create_import_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('import_category', [
            'id' => $this->primaryKey(),
            'import_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'name' => $this->string()->notNull()
        ]);

        $this->addForeignKey('fk-import_category-import_id', 'import_category', 'import_id', 'import', 'id', 'CASCADE');

        $this->createIndex('idx-import_category-category_id', 'import_category', 'category_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import_category-import_id', 'import_category');

        $this->dropTable('import_category');
    }
}
