<?php

use yii\db\Migration;

/**
 * Class m220421_154646_create_tbl_feed
 */
class m220421_154646_create_tbl_feed extends Migration
{
    public function up()
    {
        $this->dropTable('tbl_feed');
        $this->createTable('tbl_feed', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'desciption' => $this->string(255)->defaultValue(Null),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
            'updated_on' => $this->dateTime(),
        ]);
        
        // creates index for column `author_id`
        $this->createIndex(
            'idx-dept-created_by_id',
            'tbl_feed',
            'created_by_id'
            );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        
        $this->dropTable('tbl_feed');
    }
}
