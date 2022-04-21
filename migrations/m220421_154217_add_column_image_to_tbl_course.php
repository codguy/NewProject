<?php

use yii\db\Migration;

/**
 * Class m220421_154217_add_column_image_to_tbl_course
 */
class m220421_154217_add_column_image_to_tbl_course extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('tbl_course', 'image', 'VARCHAR(150)');
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // 
        
        $this->dropColumn('tbl_course', 'image');
    }
}
