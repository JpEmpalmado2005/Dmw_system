<?php 
    $current_page =  trim(basename($_SERVER['PHP_SELF'])); 
?>
<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="/index.html" title="Sleek Dashboard">
                <img src="images/logo.png" class="logo-small" />
                <span class="brand-name">Migrant Workers Processing Division</span>
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub <?=$current_page=="dashboard.php" ? "active" : "" ?>">
                    <a class="sidenav-item-link" aria-expanded="false" aria-controls="dashboard" href="dashboard.php">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li
                    class="has-sub <?= $current_page == "Professional.php" || $current_page == "Household.php" || $current_page == "Denied.php" ? "active expand" : "" ?>">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#direct_hire" aria-expanded="false" aria-controls="direct_hire">
                        <i class="mdi mdi-briefcase"></i>
                        <span class="nav-text">Direct Hire</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse  <?= $current_page == "Professional.php" || $current_page == "Household.php" || $current_page == "Denied.php" ? "show" : "" ?>"
                        id="direct_hire" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li <?=$current_page=="Professional.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="Professional.php">
                                    <span class="nav-text">Professional</span>
                                </a>
                            </li>
                            <li <?=$current_page=="Household.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="Household">
                                    <span class="nav-text">Household</span>
                                </a>
                            </li>
                            <li <?=$current_page=="Denied.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="Denied.php">
                                    <span class="nav-text">Denied</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                <li
                    class="has-sub  <?= $current_page == "OFWInformation.php" || $current_page == "Evaluation.php" || $current_page == "Payment.php" ? "active expand" : "" ?>">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#work_resumption" aria-expanded="false" aria-controls="work_resumption">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Balik Manggagawa</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse <?= $current_page == "OFWInformation.php" || $current_page == "Evaluation.php" || $current_page == "Payment.php" ? "show" : "" ?>"
                        id="work_resumption" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li <?=$current_page=="OFWInformation.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="OFWInformation.php">
                                    <span class="nav-text">OFW's Information</span>
                                </a>
                            </li>
                            <li <?=$current_page=="Evaluation.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="Evaluation.php">
                                    <span class="nav-text">Evaluation</span>
                                </a>
                            </li>
                            <li <?=$current_page=="Payment.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="Payment.php">
                                    <span class="nav-text">Payment</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                <li class="has-sub  <?=$current_page == 'InfoSheet.php' ? 'active' : '';?>">
                    <a class="sidenav-item-link" aria-expanded="false" aria-controls="information_sheet"
                        href="InfoSheet.php">
                        <i class="mdi mdi-account-details"></i>
                        <span class="nav-text">Information Sheet</span>
                    </a>
                </li>

                <li
                    class="has-sub <?= $current_page == "PRAContacts.php" || $current_page == "PESOContacts.php" || $current_page == "JobFairs.php" || $current_page == "JobFairsSummary.php" ? "active expand" : "" ?>">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#job_fairs" aria-expanded="false" aria-controls="job_fairs">
                        <i class="mdi mdi-account-search"></i>
                        <span class="nav-text">Job Fairs</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse <?= $current_page == "PRAContacts.php" || $current_page == "PESOContacts.php" || $current_page == "JobFairs.php" || $current_page == "JobFairsSummary.php" ? "show" : "" ?>"
                        id="job_fairs" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li <?=$current_page=="JobFairs.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="JobFairs.php">
                                    <span class="nav-text">Job Fairs</span>
                                </a>
                            </li>
                            <li <?=$current_page=="PESOContacts.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="PESOContacts.php">
                                    <span class="nav-text">PESO Contacts</span>
                                </a>
                            </li>
                            <li <?=$current_page=="PRAContacts.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="PRAContacts.php">
                                    <span class="nav-text">PRA'S Contacts</span>
                                </a>
                            </li>
                            <li <?=$current_page=="JobFairsSummary.php" ? "class='active'" : "" ?>>
                                <a class="sidenav-item-link" href="JobFairsSummary.php">
                                    <span class="nav-text">Job Fair Monitoring Summary</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                <li class="has-sub <?=$current_page == 'GovToGov.php' ? 'active' : '';?>">
                    <a class="sidenav-item-link" aria-expanded="false" aria-controls="gov_to_gov" href="GovToGov.php">
                        <i class="mdi mdi-bank"></i>
                        <span class="nav-text">Gov to Gov</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- end nav -->
    </div>
</aside>