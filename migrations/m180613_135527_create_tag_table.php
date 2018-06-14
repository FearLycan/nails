<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m180613_135527_create_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'frequency' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%tag_created_at_index}}', '{{%tag}}', 'created_at');
        $this->createIndex('{{%tag_updated_at_index}}', '{{%tag}}', 'updated_at');
        $this->createIndex('{{%tag_name_index}}', '{{%tag}}', 'name');

        $this->addForeignKey('{{%tag_author_id_fk}}', '{{%tag}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%tag}}');
    }
}
