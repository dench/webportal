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
            'user_id' => $this->integer()->notNull(),
            'remote_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer(),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createIndex('idx-import_category-remote_id', 'import_category', 'remote_id');

        $this->addForeignKey('fk-import_category-user_id', 'import_category', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk-import_category-parent_id', 'import_category', 'parent_id', 'import_category', 'remote_id', 'CASCADE');

        $this->addForeignKey('fk-import_category-category_id', 'import_category', 'category_id', 'product_category', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-import_category-user_id', 'import_category');

        $this->dropForeignKey('fk-import_category-parent_id', 'import_category');

        $this->dropForeignKey('fk-import_category-category_id', 'import_category');

        $this->dropTable('import_category');
    }
}
