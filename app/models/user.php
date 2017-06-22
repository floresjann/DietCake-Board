<?php
class User extends AppModel
{
    public $user_validated = true;
    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', 1, 16,
            ),
        ),
        'password' => array(
            'length' => array(
                'validate_between', 1, 16,
            ),
        ),
    );

    public function login()
    {
        $db = DB::conn();
        $user = $db->row('SELECT username, password FROM user WHERE username = ? and password = ?', array($this->username, md5($this->password)));

        if (!$user) {
            $this->user_validated = false;
            throw new RecordNotFoundException();
        }

        return new self($user);
    }

    public function registerUser(User $user)
    {
        if (!$this->validate() || $this->isUserExisting()) {
            throw new ValidationException('Invalid user information');
        }
        $db = DB::conn();
        $params = array(
            'username' => $this->username,
            'password' => md5($this->password)
        );
        $db->insert('user', $params);
    }

    public function isUserExisting()
    {
        $db = DB::conn();
        $row = $db->row('SELECT 1 FROM user WHERE username = ?', array($this->username));
        return $row ? true : false;
    }
}