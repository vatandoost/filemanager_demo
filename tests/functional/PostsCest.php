<?php

use app\models\Post;
use Faker\Factory;
use vatandoost\filemanager\libs\FileHelper;
use yii\helpers\VarDumper;

class PostsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    private function getFaker()
    {
        return Factory::create();
    }

    // tests
    public function viewPostsListPage(FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        $I->amOnRoute('post');
        $I->see('Posts');
    }

    public function CreatePost(FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        $I->amOnRoute('post/create');
        $I->see('Create Post');
        $I->attachFile('#post-background', 'files/elephent.png');
        $title = $this->getFaker()->text();
        $I->fillField('Post[title]', $title);
        $I->fillField('Post[text]', 'Hello description');
        $I->submitForm('#post-form', []);

        $I->expectTo('see record created');
        $I->seeRecord(Post::class, ['title' => $title]);

        $I->expectTo('see file moved to web/uploads folder');
        $post = Post::findOne(['title' => $title]);
        $info = FileHelper::getFileInfo($post->background_image_id);
        $I->seeFileFound("$info[guid].$info[extension]", Yii::getAlias('@app/web/uploads/post'));
        $I->seeFileFound("$info[guid]_thumb.$info[extension]", Yii::getAlias('@app/web/uploads/post'));

        $I->expectTo('remove files successfully');
        FileHelper::deleteFile($post->background_image_id);
        $I->dontSeeFileFound("$info[guid].$info[extension]", Yii::getAlias('@app/web/uploads/post'));
        $I->dontSeeFileFound("$info[guid]_thumb.$info[extension]", Yii::getAlias('@app/web/uploads/post'));
    }
}
