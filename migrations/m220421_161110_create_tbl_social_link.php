<?php

use yii\db\Migration;

/**
 * Class m220421_161110_create_tbl_social_link
 */
class m220421_161110_create_tbl_social_link extends Migration
{
    
    public function up()
    {
        $this->createTable('tbl_social_link', [
            'id' => $this->primaryKey(),
            'platform' => $this->string(255)->notNull(),
            'link' => $this->string()->notNull(),
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
        $this->dropTable('tbl_social_link');
    }
    
    
}
