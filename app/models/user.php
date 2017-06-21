<?php
class User extends AppModel
{
    const ERR_DUPLICATE_ENTRY = 1062;
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

    public function login(User $user)
    {
        if (!$this->isUserExisting() || !$this->isPasswordMatch()) {
            $this->user_validated = false;
        }
        $username = $this->username;
        $password = $this->password;

        $db = DB::conn();
        $user = $db->row('SELECT username, password FROM user WHERE username = ? and password = ?', array($username, md5($password)));

        if (!$user) {
            throw new RecordNotFoundException();
            $this->user_validated = false;
        }

        return new self($user);
    }

    public function isUserExisting()
    {
        $db = DB::conn();
        $row = $db->row('SELECT 1 FROM user WHERE username = ?', array($this->username));
        return $row ? true : false;
    }

    public function isPasswordMatch()
    {
        $username = $this->username;
        $password = $this->password;

        $db = DB::conn();
        $row = $db->row('SELECT password FROM user WHERE username = ? and password = ?', array($username, md5($password)));
        return $row ? true : false;
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
}