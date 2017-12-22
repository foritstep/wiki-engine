<?php

use yii\db\Migration;

/**
 * Handles the creation of table `editors`.
 */
class m171222_155055_create_editors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('editors', [
            'nick' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
        ]);
        $this->createIndex ('editors-index', 'editors', 'nick', true);
        $this->addPrimaryKey('pk-constraint', 'editors', 'nick');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('editors');
    }
}
