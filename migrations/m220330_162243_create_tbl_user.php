<?php

use yii\db\Migration;

/**
 * Class m220330_162243_create_tbl_user
 */
class m220330_162243_create_tbl_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('tbl_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(25)->notNull(),
            'email' => $this->string(25)->notNull(),
            'password' => $this->string(30)->notNull(),
            'roll_id' => $this->tinyInteger()->notNull(),
            'state_id' => $this->tinyInteger()->notNull(),
            'dob' => $this->date()->defaultValue(Null),
            'authKey' => $this->string(10)->notNull(),
            'accessToken' => $this->string(10)->notNull(),
            'gender' => $this->string(10),
            'profile_picture' => $this->string(50)->defaultValue(null),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
            'updated_on' => $this->dateTime(),
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tbl_user');
    }

}
