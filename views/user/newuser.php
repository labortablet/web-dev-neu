<?php

?>
<div id="contentPanel">
    <h1 style="text-align:center;">New User</h1>
    <div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
        <p class="bg-success"><?php echo successMsg(); ?></p>
        <p class="bg-danger"><?php echo errorMsg(); ?></p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="createUser" />
            <p>
                <input type="text" name="firstname" value="<?php echo @$cleanData['firstname']; ?>" placeholder="First name" class="form-control" required />
            </p>
            <p>
                <input type="text" name="lastname" value="<?php echo @$cleanData['lastname']; ?>" placeholder="Last name" class="form-control" required  />
            </p>
            <p>
                <input type="text" name="email" value="<?php echo @$cleanData['email']; ?>" placeholder="E-Mail" class="form-control" required  />
            </p>
            <p>
                <input type="password" name="password" placeholder="Password" class="form-control" required  />
            </p>
            <p>
                <input type="password" name="password2" placeholder="Confirm password" class="form-control" required  />
            </p>
            <p>
                <input type="submit" value="Create user" class="form-control" required  />
            </p>
        </form>
    </div>
    
</div>