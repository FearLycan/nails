<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180613_135059_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),
            'description' => $this->text(),
            'status' => $this->smallInteger(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);
        $this->createIndex('{{%category_created_at_index}}', '{{%category}}', 'created_at');
        $this->createIndex('{{%category_updated_at_index}}', '{{%category}}', 'updated_at');
        $this->addForeignKey('{{%category_author_id_fk}}', '{{%category}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
