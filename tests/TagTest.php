<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Tag.php";
    // require_once "src/Post.php";

    $server = 'mysql:host=localhost:8889;dbname=blog_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TagTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Tag::deleteAll();
        }
        function test_save()
        {
            $name = "Thailand";
            $new_tag = new Tag($name, null);

            $new_tag->save();

            $result = Tag::getAll();
            $this->assertEquals($new_tag, $result[0]);
        }

        function test_getAll()
        {
            $name = "Thailand";
            $new_tag = new Tag($name);
            $new_tag->save();
            $result = Tag::getAll();

            $this->assertEquals($new_tag, $result[0]);
        }
        function test_deleteAll()
        {
            $name = "Thailand";
            $new_tag = new Tag($name);

            $new_tag->save();
            Tag::deleteAll();
            $result = Tag::getAll();

            $this->assertEquals([], $result);
        }
    }

?>
