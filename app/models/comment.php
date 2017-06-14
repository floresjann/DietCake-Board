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

    
}
