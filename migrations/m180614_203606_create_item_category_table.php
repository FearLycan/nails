<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item_category`.
 */
class m180614_203606_create_item_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%item_category}}', [
            'item_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('{{%item_category_pk}}', '{{%item_category}}', ['item_id', 'category_id']);
        $this->addForeignKey('{{%item_id_fk}}', '{{%item_category}}', 'item_id', '{{%item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%category_id_fk}}', '{{%item_category}}', 'tag_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%item_id_fk}}', '{{%game_genre}}');
        $this->dropForeignKey('{{%category_id_fk}}', '{{%game_genre}}');
        $this->dropTable('{{%item_category}}');
    }
}
