<?php

use yii\db\Migration;

/**
 * Class m220421_155808_create_tbl_image
 */
class m220421_155808_create_tbl_image extends Migration
{
    public function up()
    {
        $this->createTable('tbl_image', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'model' => $this->string(255)->defaultValue(Null),
            'model_id' => $this->integer()->notNull(),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
            'updated_on' => $this->dateTime(),
        ]);
        
        // creates index for column `author_id`
        $this->createIndex(
            'idx-dept-created_by_id',
            'tbl_image',
            'created_by_id'
            );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        
        $this->dropTable('tbl_image');
    }
}
