<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visitor`.
 */
class m180615_185730_create_visitor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%visitor}}', [
            'id' => $this->primaryKey(),
            'IP' => $this->string(15)->notNull(),
            'item_id' => $this->integer()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'visit' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%visitor}}');
    }
}
