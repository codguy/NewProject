<?php

use yii\db\Migration;

/**
 * Class m220421_161515_create_tbl_like
 */
class m220421_161515_create_tbl_like extends Migration
{
    
    public function up()
    {
        $this->createTable('tbl_like', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255)->defaultValue(Null),
            'model_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_on' => $this->dateTime(),
            'updated_on' => $this->dateTime(),
        ]);
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tbl_like');
    }
    
}
