<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"></i>
            </a>
            <a href="dashboard.php">
                <img class="img-fluid" src="assets\images\logo.png" alt="Sul benefícios" style="filter: brightness(100);">
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <span>Selecione a cidade</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="#">
                                    <i class="feather icon-map"></i> Todas as cidades
                                </a>
                            </li>
                            <?php
                            $sql = "select * from cidades";
                            $rs = $conn->query($sql);

                            if ($rs->rowCount() > 0) {
                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <li>
                                        <a href="#" data-id="<?= $ln['id'] ?>" class="select-cidade">
                                            <i class="feather icon-map"></i> <?= $ln['cidade'] ?>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>

                    </div>
                </li>
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <span><?= $_SESSION['name'] ?></span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="logout.php">
                                    <i class="feather icon-log-out"></i> Sair
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>