

<div class="hero_area">


    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.html">
                    <span>
                        <img src="images/logo-1.png">
                        <span>MIMS</span>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="vieworders.php">View Orders</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="buy.php">Request</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" style="color: white;" aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
                            <div class="dropdown-menu" style="left:-50px !important;text-decoration:none;">
                                <a class="dropdown-item" style="text-decoration: none;" href="logout.php">Logout</a>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</div>