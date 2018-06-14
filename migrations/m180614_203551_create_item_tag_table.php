<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item_tag`.
 */
class m180614_203551_create_item_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%item_tag}}', [
            'item_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('{{%item_tag_pk}}', '{{%item_tag}}', ['item_id', 'tag_id']);
        $this->addForeignKey('{{%item_id_fk}}', '{{%item_tag}}', 'item_id', '{{%item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%tag_id_fk}}', '{{%item_tag}}', 'tag_id', '{{%tag}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%item_id_fk}}', '{{%game_genre}}');
        $this->dropForeignKey('{{%tag_id_fk}}', '{{%game_genre}}');
        $this->dropTable('{{%item_tag}}');
    }
}
