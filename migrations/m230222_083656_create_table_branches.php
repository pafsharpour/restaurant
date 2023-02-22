<?php

use yii\db\Migration;

/**
 * Class m230222_070639_create_table_customer
 */
class m230222_083656_create_table_branches extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('branches', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'order_count' => $this->integer()->notNull()->defaultValue(0),
            'max_order_count' => $this->integer()->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('branches');
    }

}
