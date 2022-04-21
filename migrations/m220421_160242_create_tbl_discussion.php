<?php

use yii\db\Migration;

/**
 * Class m220421_160242_create_tbl_discussion
 */
class m220421_160242_create_tbl_discussion extends Migration
{
    
    public function up()
    {
        $this->createTable('tbl_discussion', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255)->defaultValue(Null),
            'model_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->defaultValue(1),
            'replied_to' => $this->integer()->defaultValue(1),
            'message' => $this->string(255)->notNull(),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
            'updated_on' => $this->dateTime(),
        ]);
        
        // creates index for column `author_id`
        $this->createIndex(
            'idx-dept-created_by_id',
            'tbl_discussion',
            'created_by_id'
            );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        
        $this->dropTable('tbl_discussion');
    }
    
}
