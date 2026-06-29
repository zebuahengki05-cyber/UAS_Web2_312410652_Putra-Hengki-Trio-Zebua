<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="text-center fw-bold mb-4">Sign In</h3>
                    
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-danger small border-0 py-2"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>

                    <form action="<?= base_url('/user/login_action'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-medium">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>