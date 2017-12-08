<?php

use yii\db\Migration;

/**
 * Class m171207_211427_created_first_test_pages
 */
class m171207_211427_created_first_test_pages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->delete('pages');
        $this->batchInsert('pages', ['title', 'content'], [
            ['Скрипты', "Дальнейший код должен быть показан как текст, не выполнен\n\n<p>123</p><script>alert('injection');</script>"],
            ['Существующая страница', '[page=Существующая+страница]Данная[/page] страница существует. А [page]эта[/page] - нет. Цвет ссылок должен различаться.'],
            ['index', "[h=1]Главная страница[/h]\n\nЭто страница по умолчанию. Именно на неё попадают пользователи если не укажут адрес"],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171207_211427_created_first_test_pages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171207_211427_created_first_test_pages cannot be reverted.\n";

        return false;
    }
    */
}
