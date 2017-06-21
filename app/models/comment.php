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

    public static function getByThreadId($thread_id)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ?', array($thread_id));
        foreach ($rows as $row) {
            $comments[] = new self($row);
        }
        return $comments;
    }

    public function write()
    {
        if (!$this->validate()) {
            throw new ValidationException('wrong input');
        }

        $db = DB::conn();
        $params = array(
            'thread_id' => $this->thread_id,
            'username' => $this->username,
            'body' => $this->body,
            'created' => date('Y-m-d H:i:s'),
        );
        $db->insert('comment', $params);
    }
}