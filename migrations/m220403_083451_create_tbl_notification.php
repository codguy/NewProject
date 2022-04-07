<?php

use yii\db\Migration;

/**
 * Class m220403_083451_create_tbl_notification
 */
class m220403_083451_create_tbl_notification extends Migration
{
    /* {@inheritdoc}
    */
    public function up()
    {
        $this->createTable('tbl_notification', [
            'id' => $this->primaryKey(),
            'title' => $this->string(25)->notNull(),
            'type_id' => $this->tinyInteger()->notNull(),
            'state_id' => $this->tinyInteger()->notNull(),
            'to_user_id' => $this->integer()->notNull(),
            'model' => $this->string(25)->defaultValue(Null),
            'model_id' => $this->integer(10)->notNull(),
            'icon' => $this->string(50)->defaultValue(null),
            'created_on' => $this->dateTime(),
            'created_by_id' => $this->integer()->defaultValue(1),
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tbl_notification');
    }
}
