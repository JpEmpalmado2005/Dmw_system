<?php include("header.php"); ?>
<?php global $user; ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="media widget-media p-4 bg-white border">
                            <div class="icon rounded-circle mr-4 bg-primary">
                                <i class="mdi mdi-account-tie text-white "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2" id="total-users">0</h4>
                                <p>Land Based</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="media widget-media p-4 bg-white border">
                            <div class="icon rounded-circle mr-4 bg-primary">
                                <i class="mdi mdi-account-multiple-check text-white "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2" id="new-users">0</h4>
                                <p>Rehire</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="media widget-media p-4 bg-white border">
                            <div class="icon rounded-circle mr-4 bg-primary">
                                <i class="mdi mdi-ferry text-white "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2" id="active-users">0</h4>
                                <p>Seafarer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="media widget-media p-4 bg-white border">
                            <div class="icon rounded-circle mr-4 bg-primary">
                                <i class="mdi mdi-account-group text-white "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2" id="returning-users">0</h4>
                                <p>Total of Workers</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end /row -->

                <div class="row">
                    <div class="col-xl-8 col-md-12">
                        <?php 
                        if(isset($user["approve_accounts"]) && $user["approve_accounts"] == 1 ): 
                            $unapproved = getUnapproved();
                            $count = count($unapproved);
                            if($count > 0):
                    ?>
                        <div class="media widget-media p-4 bg-white border">
                            <div class="icon rounded-circle mr-4 bg-warning">
                                <i class="mdi mdi-alert-circle-outline text-white "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h4 class="mb-2">You have <span class="count"><?=$count?></span> account(s) awaiting approval.
                                </h4>
                                <a href="ApproveAccounts.php">Approve/Reject Accounts Now</a>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="media widget-media p-4 bg-white border">
                            <div class="icon rounded-circle mr-4 bg-success">
                                <i class="mdi mdi-check text-white "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h4 class="mb-2">Great! You have no accounts to approved.</h4>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="icon mr-2" style="font-size: 24px;">
                                    <i class="mdi mdi-map-clock-outline"></i>
                                </div>
                                <h2>Annual Count of Overseas Filipino Workers</h2>
                            </div>
                            <div class="card-body">
                                <canvas id="locationChart" class="chartjs chartjs-render-monitor"
                                    style="display: block; width: 100%;" height="433"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card card-default">
                            <div class="card-body" style="padding-bottom: 20px">
                                <h2>Total of Work Resumption</h2>
                                <canvas id="genderChart" style="display: block;  width: 100%;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-body" style="padding-bottom: 20px">
                                <h2>Total of Gov to Gov</h2>
                                <canvas id="officeAnalyticsChart" style="display: block; width: 100%;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end /content-->
        </div>
    </div>

    <!-- custom js below this line -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="js/dashboard.js"></script>

    <!-- Data override (actual data) -->
    <script>
    dashboardData = <?=getDashboardGraphData()?>;
    </script>

    <?php include("footer.php"); ?>