<?php

use yii\db\Migration;

/**
 * Class m220421_160759_create_tbl_follow
 */
class m220421_160759_create_tbl_follow extends Migration
{
    
    public function up()
    {
        $this->createTable('tbl_follow', [
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
        
        $this->dropTable('tbl_follow');
    }
    
    
}
