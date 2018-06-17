<?php

use yii\db\Migration;

/**
 * Handles adding frequency to table `category`.
 */
class m180615_192035_add_frequency_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'frequency', $this->integer()->defaultValue(0)->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'frequency');
    }
}
