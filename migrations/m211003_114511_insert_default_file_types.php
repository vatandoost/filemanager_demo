<?php

use vatandoost\filemanager\models\FileType;
use yii\db\Migration;

/**
 * Class m211003_114511_insert_default_file_types
 */
class m211003_114511_insert_default_file_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            'name' => 'virtual',
            'title' => 'Virtual Files',
            'is_public' => true,
            'mime_types' => '',
            'max_size' => '',
            'extensions' => 'jpg,png,jpeg',
            'files_path' => 'virtual',
            'manager_class' => '',
            'handler_type' => 1,
            'has_public_thumb' => true,
            'has_force_relation_id' => false,
        ];
        $fileType = new FileType($data);
        $fileType->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        FileType::deleteAll(['name' => 'virtual']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211003_114511_insert_default_file_types cannot be reverted.\n";

        return false;
    }
    */
}
