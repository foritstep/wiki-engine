<?php

use yii\db\Migration;

/**
 * Handles the creation of table `discussions`.
 */
class m171222_131504_create_discussions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('discussion', [
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'purified_content' => $this->text(),
        ]);
        $this->createIndex ('discussion-index', 'discussion', 'title', true);
        $this->addPrimaryKey('pk-constraint', 'discussion', 'title');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('discussions');
    }
}
