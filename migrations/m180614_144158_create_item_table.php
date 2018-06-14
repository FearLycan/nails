<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item`.
 */
class m180614_144158_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'image' => $this->string(),
            'description' => $this->text(),
            'status' => $this->smallInteger(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%item_created_at_index}}', '{{%item}}', 'created_at');
        $this->createIndex('{{%item_updated_at_index}}', '{{%item}}', 'updated_at');
        $this->createIndex('{{%item_title_index}}', '{{%item}}', 'title');
        $this->createIndex('{{%item_slug_index}}', '{{%item}}', 'slug');

        $this->addForeignKey('{{%item_author_id_fk}}', '{{%item}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
