<?php if(!$user->user_validated): ?>
    <div class="row_alert">
        <div class="col-md-4 col-md-offset-8">
            <div class="alert alert-danger fade in alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Ooops!</strong> Invalid Username or Password
            </div>
        </div>
    </div>
<?php endif ?>

<form class="well" method="post" action="">
    <h2>Login</h2>
    <label>Username</label>
    <input type="text" class="span2" name="username" value="<?php eh(Param::get('username')) ?>">
    <label>Password</label>
    <input type="password" class="span2" name="password" value="<?php eh(Param::get('password')) ?>">
    <br />
    <input type="hidden" name="page_next" value="login_end">
    <button type="submit" class="btn btn-primary">Login</button>
    <br>
    <text> Not yet registered? <a href="<?php eh(url('user/registeruser')) ?>"> Sign Up Now!</a></text>
</form>
