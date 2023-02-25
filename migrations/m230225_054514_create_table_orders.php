<?php

use yii\db\Migration;

/**
 * Class m230225_054514_create_table_orders
 */
class m230225_054514_create_table_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'orderNumber'=> $this->string()->notNull(),
            'customer'=> $this->string()->notNull(),
            'branch'=> $this->string()->notNull(),
            'foodType' =>  $this->string()->notNull(),
            'foods' =>  $this->string()->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230225_054514_create_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
