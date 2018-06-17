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
        $this->addForeignKey('{{%item_category_item_id_fk}}', '{{%item_category}}', 'item_id', '{{%item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%item_category_category_id_fk}}', '{{%item_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%item_category_item_id_fk}}', '{{%item_category}}');
        $this->dropForeignKey('{{%item_category_category_id_fk}}', '{{%item_category}}');
        $this->dropTable('{{%item_category}}');
    }
}
