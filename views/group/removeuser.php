<?php
$group = getGroup();
$user = getUser();
?>
<div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
    <h1 style="text-align:center;">Remove User from Group</h1>
    <div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
        <p>
            Are you sure to remove <strong><?php echo "{$user['firstname']} {$user['lastname']}"; ?></strong> from <strong><?php echo "{$group['name']}"; ?></strong>?
        </p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="removeUser" />
            <input type="submit" value="Delete" class="form-control btn-danger" />
        </form>
        <p>
            <a href="<?php echo PROJECT_ROOT ?>/group/info/<?php echo $group['id']; ?>" class="btn btn-default form-control">Cancel</a>
        </p>
    </div>
    
</div>