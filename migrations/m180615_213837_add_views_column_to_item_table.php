<?php

use yii\db\Migration;

/**
 * Class m180615_213837_add_visits_columnt_to_item_table
 */
class m180615_213837_add_views_column_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%item}}', 'views', $this->integer()->defaultValue(0)->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%item}}', 'views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180615_213837_add_visits_columnt_to_item_table cannot be reverted.\n";

        return false;
    }
    */
}
