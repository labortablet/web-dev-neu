<?php
$group = getGroup();
?>
<div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
    <h1 style="text-align:center;">Delete Group: <?php echo "{$group['name']} (ID {$group['id']})"; ?></h1>
    <div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
        <p>
            Are you sure to <strong>delete <?php echo "{$group['name']}"; ?></strong>?
        </p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="deleteGroup" />
            <input type="submit" value="Delete" class="form-control btn-danger" />
        </form>
        <p>
            <a href="<?php echo PROJECT_ROOT ?>/group/overview" class="btn btn-default form-control">Cancel</a>
        </p>
    </div>
    
</div>