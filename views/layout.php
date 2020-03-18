<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<header>
    <div class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <h2 class="text-white">
                        Task.me
                    </h2>
                </div>
                <div class="col-sm-12 col-md-9">
                    <?php if(is_admin()): ?>
                        <form class="form-inline float-sm-center float-md-right" action="/" method="post">
                            <?php if(is_admin()): ?>
                                <h4 class="mt-1 mr-3">
                                    <span class="badge badge-danger">Be careful you have ADMIN access</span>
                                </h4>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary mb-1 mt-1" name="logout" value="Login">Logout</button>
                        </form>
                    <?php else: ?>
                        <form class="form-inline float-sm-center float-md-right" action="/" method="post">
                            <div class="form-group mb-1 mt-1 mr-1">
                                <input type="text" class="form-control" name="login" placeholder="Login ...">
                            </div>
                            <div class="form-group mb-1 mt-1 mr-1">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password ...">
                            </div>
                            <button type="submit" class="btn btn-primary mb-1 mt-1" name="login_action" value="Login">Login</button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <?php
            /** @var string $content */
            echo $content;
        ?>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/assets/js/script.js"></script>

</body>
</html>
