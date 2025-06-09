<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <?php if(isset($user["approve_accounts"]) && $user["approve_accounts"] == 0 ):
                    echo "<div class='info info-error'>You don't have a permission to approve accounts.</div>";
                else:?>
                <h2>Approve/Reject Accounts</h2>
                <?php endif; ?>


                <div class="card">
                    <div class="card-body">
                        <div class="table-container">
                            <?php
                $headers = [
                    "ID",
                    "Name",
                    "Username",
                    "Email",
                    "Type",
                    "Is Approved"
                ];
                $data = [];
                $offset = 0;
                $sql = "SELECT * FROM users ORDER BY id ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $count = $offset + 1;
                    while($row = $result->fetch_assoc()) {
                        $d = [ 
                            $count, 
                            $row["name"], 
                            $row["username"], 
                            $row["email_address"], 
                            $row["account_type"],
                            $row["is_approved"] == 1 ? "Yes" : ($row["is_approved"] == 0  ? "No" : "Rejected"),
                            $row["id"]
                        ];
                        array_push($data, $d) ;
                        $count++;
                    }
                }

                $customRenderer = function($row, $id) {
                    $data = json_encode($row);
                    if($row[5] === "No"){
                        $approve_html = "<a class='icon-btn approve-btn edit-btn' data-info='$data' href='#'><i class='fas fa-check'></i> Approve</a>";
                        $reject_html = "<a class='icon-btn reject-btn delete-btn' data-info='$data' href='#'><i class='fas fa-times'></i> Reject </a>";
                        return $approve_html . $reject_html;
                    }else{
                        return "";
                    }
                };

                echo generateDataTable( $headers, $data, "No records found", true, false, $customRenderer );
            ?>
                        </div>
                    </div>
                </div>


            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->

<script>
jQuery(function () {
    $(".approve-btn").on("click", function () {
        var _data = $(this).data("info");
        var _id = parseInt(_data[6]);
        var _name = _data[1];

        console.log(_id);

        if (confirm("Are you sure you want to approve user account of : " + _name + "?")) {
            $.ajax({
                url: "Ajax.php", 
                method: "POST",
                data: {
                    id: _id,
                    name: _name,
                    action: "approve"
                },
                success: function (response) {
                    alert(response.message);
                    console.log("approval", response);
                    location.reload(); 
                },
                error: function (xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
    });

    $(".reject-btn").on("click", function () {
        var _data = $(this).data("info");
        var _id = parseInt(_data[6]);
        var _name = _data[1];

        if (confirm("Are you sure you want to reject user account of : " + _name + "?")) {
            $.ajax({
                url: "Ajax.php", 
                method: "POST",
                data: {
                    id: _id,
                    name: _name,
                    action: "reject"
                },
                success: function (response) {
                    alert(response.message);
                    console.log("reject", response);
                    location.reload(); 
                },
                error: function (xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
    });
});
</script>

<?php include("footer.php"); ?>