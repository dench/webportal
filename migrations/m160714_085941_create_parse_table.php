<?php

use yii\db\Migration;

/**
 * Handles the creation for table `parse`.
 */
class m160714_085941_create_parse_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parse', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'format_id' => $this->smallInteger()->notNull(),
            'time' => $this->integer()->notNull(),
            'created' => $this->integer()->notNull(),
            'rate' =>$this->decimal(4,2)->defaultValue(1),
            'status' => $this->boolean()->notNull()->defaultValue(0)
        ]);

        $this->addForeignKey('fk-parse-user_id', 'parse', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-parse-user_id', 'parse');

        $this->dropTable('parse');
    }
}
