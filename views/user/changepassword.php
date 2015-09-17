<?php
$user = getUser();
?>
<div id="contentPanel">
    <h1 style="text-align:center;">Set Password for: <?php echo "{$user['firstname']} {$user['lastname']} (ID {$user['id']})"; ?></h1>
    <div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
        <p class="bg-success"><?php echo successMsg(); ?></p>
        <p class="bg-danger"><?php echo errorMsg(); ?></p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="changePassword" />
            <p> 
                <input type="password" name="password" class="form-control" placeholder="New password" required />
            </p>
            <p> 
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm new password" required />
            </p>
            <p> 
                <input type="submit" class="form-control" />
            </p>
        </form>
    </div>
    
</div>