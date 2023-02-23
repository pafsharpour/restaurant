<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%foods}}`.
 */
class m230223_081436_create_foods_table extends Migration
{
      public function safeUp()
        {
            $this->createTable('foods', [
                'id' => $this->primaryKey(),
                'name'=> $this->string()->notNull(),
                'type'=> $this->string()->notNull(),
                'branch'=> $this->string()->notNull(),
                'orderable' => $this->integer()->notNull(),
                'ordered' => $this->integer()->notNull()->defaultValue(0),
    
            ]);
        }
    
        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('foods');
        }
        /*
        // Use up()/down() to run migration code without a transaction.
        public function up()
        {
    
        }
    
        public function down()
        {
            echo "m230223_064554_create_table_food cannot be reverted.\n";
    
            return false;
        }
        */
    }
    