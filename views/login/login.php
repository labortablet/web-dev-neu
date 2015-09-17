<?php

?>
<div id="contentPanel">
    <h1 style="text-align:center;">Login</h1>
    <div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
        <p class="bg-success"><?php echo successMsg(); ?></p>
        <p class="bg-danger"><?php echo errorMsg(); ?></p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="login" />
            <p> 
                <input type="text" name="email" class="form-control" placeholder="E-Mail" required />
            </p>
            <p> 
                <input type="password" name="password" class="form-control" placeholder="Password" required />
            </p>
            <p> 
                <input type="submit" class="form-control" />
            </p>
        </form>
    </div>
    
</div>