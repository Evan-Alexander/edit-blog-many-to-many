<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Post.php";
    require_once "src/Post.php";

    $server = 'mysql:host=localhost:8889;dbname=blog_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PostTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Post::deleteAll();
        }
        function test_save()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);

            $new_post->save();

            $result = Post::getAll();
            $this->assertEquals($new_post, $result[0]);
        }

        function test_getAll()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);
            $new_post->save();
            $result = Post::getAll();

            $this->assertEquals($new_post, $result[0]);
        }
        function test_deleteAll()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);

            $new_post->save();
            Post::deleteAll();
            $result = Post::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);
            $new_post->save();

            $title2 = "Zimbabwe";
            $date = '1999-11-11';
            $new_post2 = new Post($title2, $date, null);
            $new_post2->save();


            $result = Post::find($new_post2->getId());

            $this->assertEquals($new_post2, $result);
        }
    }

?>
