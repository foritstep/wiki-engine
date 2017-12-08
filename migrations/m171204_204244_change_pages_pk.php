<?php

use yii\db\Migration;

/**
 * Class m171204_204244_change_pages_pk
 */
class m171204_204244_change_pages_pk extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('pages', 'id');
        $this->createIndex ('pages-index', 'pages', 'title', true);
        $this->addPrimaryKey('pk-constraint', 'pages', 'title');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171204_204244_change_pages_pk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171204_204244_change_pages_pk cannot be reverted.\n";

        return false;
    }
    */
}
