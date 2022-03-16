<body class="bg-gradient-primary">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent ">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                <h1 class="text-light"><a href="<?= base_url('landingpage') ?>"><span>Servisanku.com</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="active " href="<?= base_url('landingpage') ?>">Home</a></li>
                    <li><a href="<?= base_url('auth') ?>">Log In</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <div class="container mt-4">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                                <div class="form-group">
                                    <input type="text" id="name" name="name" class="form-control form-control-user" placeholder="Full Name" value="<?= set_value('name'); ?>">
                                    <?= form_error('name', '<small class="text-danger" pl-3>', '</small>'); ?>
                                    <!-- untuk membuat pesan error name -->
                                </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-control-user" id="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger" pl-3>', '</small>'); ?>
                                    <!-- untuk membuat pesan error email -->

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger" pl-3>', '</small>') ?>
                                        <!-- untuk membuat pesan error password1 -->
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                        <?= form_error('password2', '<small class="text-danger" pl-3>', '</small>') ?>
                                        <!-- untuk membuat pesan error password2 -->
                                    </div>
                                </div>
                                <button type="submit" href="login.html" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/forgotPassword') ?>">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>