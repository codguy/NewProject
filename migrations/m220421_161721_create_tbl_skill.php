<?php

use yii\db\Migration;

/**
 * Class m220421_161721_create_tbl_skill
 */
class m220421_161721_create_tbl_skill extends Migration
{
    
    public function up()
    {
        $this->createTable('tbl_skill', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255)->defaultValue(Null),
            'model_id' => $this->integer()->notNull(),
            'skill' => $this->string(25)->notNull(),
            'created_on' => $this->dateTime(),
            'updated_on' => $this->dateTime(),
        ]);
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tbl_skill');
    }
    
}
