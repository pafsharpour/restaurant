<?php

use yii\db\Migration;

/**
 * Class m230222_135504_create_table_foodtype
 */
class m230222_135504_create_table_foodtype extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('foodtype', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('foodtype');
    }
}
