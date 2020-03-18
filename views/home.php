<div class="col-12 mt-5">
    <?php if($_REQUEST['error']): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $_REQUEST['error']['message']; ?>
        </div>
    <?php endif; ?>
    <?php if($_REQUEST['success']): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $_REQUEST['success']['message']; ?>
        </div>
    <?php endif; ?>
    <form class="form-row" method="post">
        <div class="form-group col-sm-12 col-md-2">
            <label for="name">User name</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="User name" required>
        </div>
        <div class="form-group col-sm-12 col-md-3">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <label for="description">Description</label>
            <input type="text" id="description" class="form-control" name="description" placeholder="Description" required>
        </div>
        <div class="form-group col-sm-12 col-md-1 d-flex align-items-end px-0">
            <button type="submit" class="btn btn-primary align-bottom w-100" name="create" value="Create">Add task</button>
        </div>
    </form>
    <hr>
</div>
<div class="col-12 mt-3">
    <form id="update-form" class="form-row" method="post" style="display: none">
        <input type="hidden" id="u-id" name="id" value="id">
        <div class="form-group col-sm-12 col-md-2">
            <label for="u-name">User name</label>
            <input type="text" id="u-name" class="form-control" name="name" placeholder="User name" required>
        </div>
        <div class="form-group col-sm-12 col-md-3">
            <label for="u-email">Email</label>
            <input type="email" id="u-email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-group col-sm-12 col-md-4 align-center">
            <label for="u-description">Description</label>
            <input type="text" id="u-description" class="form-control" name="description" placeholder="Description" required>
        </div>
        <div class="form-group col-sm-12 col-md-1 justify-content-center">
            <label for="u-completed">Completed</label>
            <input type="checkbox" id="u-completed" class="form-control" name="completed" value="1" style="width: 30px;height: 30px">
        </div>
        <div class="form-group col-sm-12 col-md-1 d-flex align-items-end px-0">
            <button type="submit" class="btn btn-success align-bottom w-100" name="update" value="Update">Update</button>
        </div>
        <div class="form-group col-sm-12 col-md-1 d-flex align-items-end px-1">
            <button id="update-close" type="button" class="btn btn-danger align-bottom w-100">Close</button>
        </div>
    </form>
    <hr class="mb-0"/>

    <form action="/" method="get" class="row bg-light pt-2 mx-0">
        <div class="form-group col-sm-12 col-md-2">
            <h4>Filter</h4>
        </div>
        <div class="form-group col-sm-12 col-md-3">
            <label for="order_by">Order by</label>
            <select class="form-control" id="order_by" name="order_by">
                <option value="id" <?php echo selected('id', $order_by); ?>>default</option>
                <option value="name" <?php echo selected('name', $order_by); ?>>user name</option>
                <option value="email" <?php echo selected('email', $order_by); ?>>email</option>
                <option value="completed" <?php echo selected('completed', $order_by); ?>>status</option>
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-2">
            <label for="order_by">Order</label>
            <select class="form-control" id="order_by" name="order">
                <option value="ASC" <?php echo selected('ASC', $order); ?>>ascending</option>
                <option value="DESC" <?php echo selected('DESC', $order); ?>>descending</option>
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-1 d-flex align-items-end px-1">
            <button type="submit" class="btn btn-info align-bottom w-100">Run</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">User name</th>
                <th scope="col">Email</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <?php if(is_admin()): ?>
                    <th scope="col">Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php if($tasks): ?>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['name']; ?></td>
                    <td><?php echo $task['email']; ?></td>
                    <td><?php echo $task['description']; ?></td>
                    <td>
                        <?php if($task['completed']): ?>
                            <span class="badge badge-success">Completed</span>
                        <?php else: ?>
                            <span class="badge badge-secondary">In process</span>
                        <?php endif; ?>
                    </td>
                    <?php if(is_admin()): ?>
                        <td>
                            <button
                                class="edit-task btn btn-sm btn-warning"
                                data-id="<?php echo attr($task['id']); ?>"
                                data-name="<?php echo attr($task['name']); ?>"
                                data-email="<?php echo attr($task['email']); ?>"
                                data-description="<?php echo attr($task['description']); ?>"
                                data-completed="<?php echo attr($task['completed']); ?>"
                            >Edit</button>
                            <button class="remove-task btn btn-sm btn-danger">Delete</button>
                            <form method="post" action="/">
                                <input type="hidden" name="id" value="<?php echo attr($task['id']); ?>">
                                <input type="hidden" name="delete" value="Delete">
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>
    <?php if($pagination): ?>
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item <?php echo $pagination['prev']?'':'disabled'; ?>">
                    <a class="page-link" href="<?php echo $pagination['prev']?pagin_link($pagination['prev']):'#'; ?>" tabindex="-1">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['max']; $i++): ?>
                    <li class="page-item <?php echo $i === (int)$pagination['current']?'active':''; ?>">
                        <a class="page-link" href="<?php echo pagin_link($i); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo $pagination['next']?'':'disabled'; ?>">
                    <a class="page-link" href="<?php echo $pagination['next']?pagin_link($pagination['next']):'#'; ?>">Next</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

