<?php

use yii\db\Migration;

/**
 * Handles the creation for table `parse_category`.
 */
class m160714_091839_create_parse_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parse_category', [
            'id' => $this->primaryKey(),
            'parse_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'name' => $this->string()->notNull()
        ]);

        $this->addForeignKey('fk-parse_category-parse_id', 'parse_category', 'parse_id', 'parse', 'id', 'CASCADE');

        $this->createIndex('idx-parse_category-category_id', 'parse_category', 'category_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-parse_category-parse_id', 'parse_category');

        $this->dropTable('parse_category');
    }
}
