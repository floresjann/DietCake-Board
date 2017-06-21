<?php
class UserController extends AppController
{
    public function registerUser()
    {
        $user = new User();
        $page = Param::get('page_next', 'registeruser_end');

        switch ($page) {
            case 'registeruser':
                break;

            case 'registeruser_end':
                $user->username = Param::get('username');
                $user->password = Param::get('password');
                try {
                    $user = $user->registerUser($user);
                } catch (ValidationException $e) {
                    $page = 'registeruser';
                }
                break;
            default:
                throw new RecordNotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function login()
    {
        if (isset($_SESSION['username'])) {
            redirect(url('thread/viewthread'));
        }
        $user = new User();
        $page = Param::get('page_next', 'login');

        switch ($page) {
            case 'login':

                break;

            case 'login_end':
                $user->username = Param::get('username');
                $password = $user->password = Param::get('password');
                $user->password = $password;
                try {
                    $user = $user->login($user);
                    $_SESSION['username'] = $user->username;
                } catch (RecordNotFoundException $e) {
                    $page = 'login';
                }
                break;

            default:
                throw new RecordNotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}