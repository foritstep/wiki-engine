<?php

use yii\db\Migration;

/**
 * Class m171201_171421_update_pages_table
 */
class m171201_171421_update_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('pages', 'purified_content', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('pages', 'purified_content');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171201_171421_update_pages_table cannot be reverted.\n";

        return false;
    }
    */
}
