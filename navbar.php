    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-lg">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                
                <?php if($controller->isLogged()) {  ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                                <a class="nav-link <?= ($page_name === 'index') ? 'active' : '' ?>" aria-current="page" href="index.php">Index</a>
                        </li>
                        
                        <?php if($controller->isUser()) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page_name === 'shopping') ? 'active' : '' ?>" aria-current="page" href="shopping.php">GO Shooping</a>
                            </li>
                        <?php } ?>

                        <?php if($controller->isAdmin()) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page_name === 'admin') ? 'active' : '' ?>" aria-current="page" href="admin.php">Admin Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page_name === 'logs') ? 'active' : '' ?>" aria-current="page" href="logs.php">Logs Page</a>
                            </li>
                        <?php } ?>

                        <?php if(!$controller->isUser()) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page_name === 'products') ? 'active' : '' ?>" aria-current="page" href="products.php">Products Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page_name === 'orders') ? 'active' : '' ?>" aria-current="page" href="orders.php">Orders Page</a>
                            </li>
                        <?php } ?>
                    
                    </ul>


                    <span class="navbar-text">
                        <div class="text-right">Logged as: <?=  $_SESSION['username'];?></div>
                    </span>

                    <span style='color:red;margin-right:1.25em; display:inline-block;'>&nbsp;</span>
    
                    <form class="form-inline my-2 my-lg-0" action="http-handler.php" method="POST">
                        <input type="hidden" name="action" value="logout">
                        <button class="btn btn-outline-light" type="submit" name="logout" value="Logout">Logout</button>
                    </form>

                
                <?php } ?>

            </div>
        </div>
    </nav>

 



    