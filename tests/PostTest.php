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

        function test_updateTitle()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);
            $new_post->save();

            $title2 = "Zimbabwe";
            $date = '2016-11-11';
            $new_post2 = new Post($title2, $date, null);
            $new_post2->save();
            $new_title = "Paris";
            $new_post2->updateTitle($new_title);


            $search_db_for = Post::find($new_post2->getId());
            $result = $search_db_for->getTitle();

            $this->assertEquals($new_post2->getTitle(), $result);
        }
        function test_updateDate()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);
            $new_post->save();

            $title2 = "Zimbabwe";
            $date = '2016-11-11';
            $new_post2 = new Post($title2, $date, null);
            $new_post2->save();
            $new_date = "1923-11-09";
            $new_post2->updateDate($new_date);


            $search_db_for = Post::find($new_post2->getId());
            $result = $search_db_for->getDate();

            $this->assertEquals($new_post2->getDate(), $result);
        }
        
        function test_delete()
        {
            $title = "Thailand";
            $date = '1999-11-11';
            $new_post = new Post($title, $date, null);
            $new_post->save();

            $title2 = "Zimbabwe";
            $date = '2016-11-11';
            $new_post2 = new Post($title2, $date, null);
            $new_post2->save();
            $new_post2->delete();


            $result = Post::find($new_post2->getId());

            $this->assertEquals(null, $result);
        }
    }

?>
