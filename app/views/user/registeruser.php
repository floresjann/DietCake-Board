<?php if ($user->isUserExisting()): ?>
    <div class="row_alert">
        <div class="col-md-4 col-md-offset-8">
            <div class="alert alert-danger fade in alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Ooops!</strong> Username already taken
            </div>
        </div>
    </div>
<?php endif ?>
<form class="well" method="post" action="<?php eh(url('')) ?>">
    <h2>Registration</h2>
    <label>Username</label>
    <input type="text" class="span2" name="username" value="<?php eh(Param::get('username')) ?>">
    <label>Password</label>
    <input type="password" class="span2" name="password" value="<?php eh(Param::get('password')) ?>">
    <input type="hidden" name="page_next" value="registeruser_end">
    <br>
    <button type="submit" class="btn btn-primary">Register</button>
    <br>
    <text> Already Registered?<a href="<?php eh(url('user/login')) ?>"> Login now!</a></text>
</form>