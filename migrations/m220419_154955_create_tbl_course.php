<?php

use yii\db\Migration;

/**
 * Class m220419_154955_create_tbl_course
 */
class m220419_154955_create_tbl_course extends Migration
{
    /*
     * {@inheritdoc}
     */
    /* public function up()
    {
        $this->createTable('tbl_course', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'desciption' => $this->string(255)->defaultValue(Null),
            'dificulty' => $this->tinyInteger(),
            'trainer_id' => $this->integer(),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
            'updated_on' => $this->dateTime(),
        ]);
        
        // creates index for column `author_id`
        $this->createIndex(
            'idx-dept-created_by_id',
            'tbl_course',
            'created_by_id'
            );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-created_by_id',
            'tbl_course',
            'created_by_id',
            'tbl_user',
            'id',
            'CASCADE'
            );
    }
    
    /**
     * {@inheritdoc}
     */
    /* public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-post-created_by_id',
            'tbl_dept'
            );
        
        $this->dropTable('tbl_course');
    }  */
}
