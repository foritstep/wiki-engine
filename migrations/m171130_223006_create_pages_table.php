<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m171130_223006_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
        ]);

        $this->batchInsert('pages', ['title', 'content'], [
            ['Первая', '[tag]Первая[/tag] страница на данном движке']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages');
    }
}
