<?php
    class Comment extends AppModel
    {

        public $validation = array(
            'username' => array(
                'length' => array(
                    'validate_between', 1, 16,
                ),
            ),
            'body' => array(
                'length' => array(
                    'validate_between', 1, 200,
                ),
            ),
        );

        public function write(Comment $comment)
        {
            if (!$comment->validate()) {
                throw new ValidationException('invalid comment');
            }
        }

        public function getComments()
        {
            return Comment::getByThreadId($this->id);
        }

        public static function getByThreadId($thread_id)
        {
            $comments = array();
            $db = DB::conn();
            $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ?', array($this->id));
            foreach ($rows as $row) {
                $comments[] = new self($row);
            }
            return $comments;
        }

    }