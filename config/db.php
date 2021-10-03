<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=files-mysql;dbname=filemanager',
    'username' => 'filemanager',
    'password' => 'secret',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
