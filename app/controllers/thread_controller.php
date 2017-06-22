<?php
class ThreadController extends AppController
{
    public function viewthread()
    {
        if (!isset($_SESSION['username'])) {
            redirect(url('user/login'));
        }
        $threads = Thread::getAll();
        $this->set(get_defined_vars());
    }

    public function view()
    {
        if (!isset($_SESSION['username'])) {
            redirect(url('user/login'));
        }
        $thread = Thread::get(Param::get('thread_id'));
        $comments = $thread->getComments();
        $this->set(get_defined_vars());
    }

    public function write()
    {
        if (!isset($_SESSION['username'])) {
            redirect(url('user/login'));
        }
        $thread = Thread::get(Param::get('thread_id'));
        $page = Param::get('page_next', 'write');

        if ($page == 'write_end') {
            $params = array(
                'thread_id' => Param::get('thread_id'),
                'username' => get_session_username(),
                'body' => Param::get('body'),
            );
            $comment = new Comment($params);
            try {
                $comment->write();
            } catch (ValidationException $e) {
                $page = 'write';
            }
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function create()
    {
        if (!isset($_SESSION['username'])) {
            redirect(url('user/login'));
        }
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next', 'create');
        switch ($page) {
            case 'create':
                break;
            case 'create_end':
                $thread->title = Param::get('title');
                $comment->username = get_session_username();
                $comment->body = Param::get('body');
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $page = 'create';
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }
}

