# Yii2 Filemanager demo

## Features

* manage posts with some kinds of files:

    * file in post table with relation id
    * file in CKEditor
    * files with selector and save in a text
* manage file types in console:
```
php yii filemanager/files/types
php yii filemanager/files/create-type
```



## Installation with docker

```

docker-compose up -d

# go inside docker container
docker exec -ti files-php

# install dependencies
composer install

# migrate up database
php yii migrate

# system is up and ready
```