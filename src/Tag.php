<?php
    Class Tag
    {
        private $name;
        private $id;

        function __construct($name,$id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tags (tag_name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tags = $GLOBALS['DB']->query("SELECT * FROM tags;");
            $tags = array();
            foreach($returned_tags as $tag) {
                $name = $tag['tag_name'];
                $id = $tag['id'];
                $new_tag = new Tag($name, $id);
                array_push($tags, $new_tag);
            }
            return $tags;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM tags;");
        }
        static function find($search_id)
        {
            $returned_tags = Tag::getAll();
            foreach($returned_tags as $tag) {
                if ($search_id == $tag->getId()){
                    return $tag;
                }
            }
            return null;
        }


    }
?>
