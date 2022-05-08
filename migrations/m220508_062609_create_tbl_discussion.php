<?php

use yii\db\Migration;

/**
 * Class m220508_062609_create_tbl_discussion
 */
class m220508_062609_create_tbl_discussion extends Migration
{
    public function up()
    {
        $this->createTable('tbl_discussion', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255)->defaultValue(Null),
            'model_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'to_user_id' => $this->integer()->defaultValue(null),
            'message' => $this->text()->notNull(),
            'state_id' => $this->tinyInteger()->defaultValue('1'),
            'created_on' => $this->dateTime(),
            'updated_on' => $this->dateTime(),
        ]);
        
    }
    
    public function down()
    {
        $this->dropTable('tbl_discussion');
    }
}
