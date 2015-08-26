<div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
    <h1 style="text-align:center;">New Project</h1>
    <div style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
        <p class="bg-success"><?php echo successMsg(); ?></p>
        <p class="bg-danger"><?php echo errorMsg(); ?></p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="createProject" />
            <p>
                <input type="text" name="name" value="<?php echo @$cleanData['name']; ?>" placeholder="Project name" class="form-control" required />
            </p>
            <p>
                <input type="text" name="description" value="<?php echo @$cleanData['description']; ?>" placeholder="Description" class="form-control" required  />
            </p>
            <p>
                <input type="submit" value="Create project" class="form-control" required  />
            </p>
        </form>
    </div>
    
</div>