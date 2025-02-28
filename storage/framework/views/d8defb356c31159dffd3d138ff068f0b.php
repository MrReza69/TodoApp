<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Authentication || webprog.io</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
</head>

<body>
    <div class="container-fluid ">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">Auth App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        
                    </li>
                    <li class="nav-item">
                        
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if(auth()->guard()->check()): ?>
                    
                    <form action="<?php echo e(route('dashboard', ['userId'])); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e(auth()->user()->id); ?>" name="userId">
                    <button class="btn btn-sm btn-secondary ms-2"><?php echo e(auth()->user()->name); ?>'s Dashboard</button>
                    </form>
                    <form action="<?php echo e(route('logout')); ?>" method="Post">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-sm btn-secondary ms-2">logout</button>
                    </form>

                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>

                    <a href="<?php echo e(route('login')); ?>" class="btn btn-sm btn-outline-dark">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-sm btn-secondary ms-2">Register</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>
<?php /**PATH /media/iliarezaei/New Volume/laravel/todo-app/resources/views/layout/header.blade.php ENDPATH**/ ?>