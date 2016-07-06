<?php

use yii\db\Migration;

/**
 * Handles the creation for table `article`.
 */
class m160706_104621_create_article_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'slug' => $this->string(100)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'text' => $this->text(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->addForeignKey('fk-article_category-pid', 'article_category', 'parent_id', 'article_category', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-article_category-pid', 'article_category');

        $this->dropTable('article_category');
    }
}
