<?php

use yii\db\Migration;

/**
 * Class m220421_155013_create_tbl_chapter
 */
class m220421_155013_create_tbl_chapter extends Migration
{
    public function up()
    {
        $this->dropTable('tbl_chapter');
        $this->createTable('tbl_chapter', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'desciption' => $this->string(5000)->defaultValue(Null),
            'dificulty' => $this->tinyInteger(),
            'course_id' => $this->integer(),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
            'updated_on' => $this->dateTime(),
        ]);
        
        // creates index for column `author_id`
        $this->createIndex(
            'idx-dept-created_by_id',
            'tbl_chapter',
            'created_by_id'
            );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        
        $this->dropTable('tbl_chapter');
    }
}
