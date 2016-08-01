<?php

use yii\db\Migration;

/**
 * Handles the creation for table `article`.
 */
class m160706_110638_create_article extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'slug' => $this->string(100)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'view' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(true)
        ]);

        $this->addForeignKey('fk-article-user_id', 'article', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('fk-article-category_id', 'article', 'category_id', 'article_category', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-article-user_id', 'article');

        $this->dropForeignKey('fk-article-category_id', 'article');
        
        $this->dropTable('article');
    }
}
