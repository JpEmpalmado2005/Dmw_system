<?php global $user; ?>
<!-- Header -->
<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>

        <!-- search form -->

        <div class="search-form d-none d-lg-inline-block">

        </div>
        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="images/user.png" class="user-image" alt="User Image" />
                        <span class="d-none d-lg-inline-block"><?=$user["name"]?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="images/user.png" class="img-circle" alt="User Image" />
                            <div class="d-inline-block">
                                <?=$user["name"]?><small class="pt-1"><?=$user["email_address"]?></small>
                            </div>
                        </li>
                        <li>
                            <a href="Profile.php"><i class="mdi mdi-account"></i> My Profile</a>
                        </li>
                        <?php if(isset($user["manage_staff"]) && $user["manage_staff"] == 1 ): ?>
                        <li>
                            <a href="ManageAccounts.php"><i class="mdi mdi-account-multiple"></i> Manage Accounts</a>
                        </li>
                        <?php endif; ?>
                        <li class="dropdown-footer">
                            <a href="#" onclick="confirmLogout(); return false;">
                                <i class="mdi mdi-logout"></i> Log Out
                            </a>
                            <form id="logout-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST"
                                style="display: none;">
                                <input type="hidden" name="logout" value="1">
                            </form>

                            <script>
                            function confirmLogout() {
                                if (confirm('Are you sure you want to log out?')) {
                                    document.getElementById('logout-form').submit();
                                }
                            }
                            </script>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>