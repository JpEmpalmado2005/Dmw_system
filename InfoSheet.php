<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>Summary Of Records</h2>

                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php 

$data = [
    'id' => '',
    'male' => '',
    'female' => '',
    'highest_pct' => '',
    'lowest_pct' => '', 
    'employment' => '',     
    'owwa' => '',
    'legal' => '',
    'loan' => '',
    'visa' => '',
    'bm' => '', 
    'rtt' => '',     
    'philhealth' => '',
    'others' => '',
    'landbased' => '',
    'rehire' => '',
    'seafarer' => '', 
    'date' => ''
];

$form_title = "Add New Record";
$form_action = "add";
$record_id = "";
$delete_confirmation = false;

if (isset($_GET['action']) && isset($_GET['id'])) {
$id = sanitize_input($_GET['id']);
$record_id = $id;

if ($_GET['action'] === 'edit') {
    $sql = "SELECT * FROM information_sheet WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $data['id'] = $row['id'];
        $data['male'] = $row['male'];
        $data['female'] = $row['female'];
        $data['highest_pct'] = $row['highest_pct'];
        $data['lowest_pct'] = $row['lowest_pct'];
        $data['employment'] = $row['employment'];
        $data['owwa'] = $row['owwa'];
        $data['legal'] = $row['legal'];
        $data['loan'] = $row['loan'];
        $data['visa'] = $row['visa'];
        $data['bm'] = $row['bm'];
        $data['rtt'] = $row['rtt'];
        $data['philhealth'] = $row['philhealth'];
        $data['others'] = $row['others'];
        $data['landbased'] = $row['landbased'];
        $data['rehire'] = $row['rehire'];
        $data['seafarer'] = $row['seafarer'];
        $data['date'] = $row['date'];
        $form_title = "Edit Record";
        $form_action = "edit";
    } else {
        echo "<div class='info info-error'>Record not found.</div>";
        exit;
    }
    $stmt->close();
} elseif ($_GET['action'] === 'delete') {
    $delete_confirmation = true;
    $sql_name = "SELECT * FROM information_sheet WHERE id = ?";
    $stmt_name = $conn->prepare($sql_name);
    if ($stmt_name === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_name->bind_param("i", $id);
    $stmt_name->execute();
    $result_name = $stmt_name->get_result();
    if ($result_name->num_rows === 1) {
        $row = $result_name->fetch_assoc();
        $data['id'] = $row['id'];
        $data['male'] = $row['male'];
        $data['female'] = $row['female'];
        $data['highest_pct'] = $row['highest_pct'];
        $data['lowest_pct'] = $row['lowest_pct'];
        $data['employment'] = $row['employment'];
        $data['owwa'] = $row['owwa'];
        $data['legal'] = $row['legal'];
        $data['loan'] = $row['loan'];
        $data['visa'] = $row['visa'];
        $data['bm'] = $row['bm'];
        $data['rtt'] = $row['rtt'];
        $data['philhealth'] = $row['philhealth'];
        $data['others'] = $row['others'];
        $data['landbased'] = $row['landbased'];
        $data['rehire'] = $row['rehire'];
        $data['seafarer'] = $row['seafarer'];
        $data['date'] = $row['date'];
    } else {
        echo "<div class='info info-error'>Record not found for deletion.</div>";
        exit;
    }
    $stmt_name->close();
}
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if( $_POST["form_action"] == "edit" || $_POST["form_action"] == "add"){

        $male = sanitize_input($_POST['male']);
        $female = sanitize_input($_POST['female']);
        $highest_pct = sanitize_input($_POST['highest_pct']);
        $lowest_pct = sanitize_input($_POST['lowest_pct']);
        $employment = sanitize_input($_POST['employment']);
        $owwa = sanitize_input($_POST['owwa']);
        $legal = sanitize_input($_POST['legal']);
        $loan = sanitize_input($_POST['loan']);
        $visa = sanitize_input($_POST['visa']);
        $bm = sanitize_input($_POST['bm']);
        $rtt = sanitize_input($_POST['rtt']);
        $philhealth = sanitize_input($_POST['philhealth']);
        $others = sanitize_input($_POST['others']);
        $landbased = sanitize_input($_POST['landbased']);
        $rehire = sanitize_input($_POST['rehire']);
        $seafarer = sanitize_input($_POST['seafarer']);
        $date = sanitize_input($_POST['date']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE information_sheet SET 
                male=?, 
                female=?, 
                highest_pct=?, 
                lowest_pct=?, 
                employment=?, 
                owwa=?, 
                legal=?,
                loan=?,
                visa=?, 
                bm=?, 
                rtt=?, 
                philhealth=?, 
                others=?, 
                landbased=?, 
                rehire=?,
                seafarer=?, 
                date=?
            WHERE id=?";

        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("iiiiiiiiiiiiiiiisi", 
            $male, 
            $female, 
            $highest_pct, 
            $lowest_pct, 
            $employment, 
            $owwa, 
            $legal, 
            $loan,
            $visa, 
            $bm, 
            $rtt, 
            $philhealth, 
            $others, 
            $landbased, 
            $rehire, 
            $seafarer, 
            $date, 
            $id_to_update
        );

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "InfoSheet.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {

        $insert_sql = "INSERT INTO information_sheet (
            male, 
            female, 
            highest_pct, 
            lowest_pct, 
            employment, 
            owwa, 
            legal,
            loan,
            visa, 
            bm, 
            rtt, 
            philhealth, 
            others, 
            landbased, 
            rehire,
            seafarer, 
            date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }

        $stmt->bind_param("iiiiiiiiiiiiiiiis", 
            $male, 
            $female, 
            $highest_pct, 
            $lowest_pct, 
            $employment, 
            $owwa, 
            $legal, 
            $loan,
            $visa, 
            $bm, 
            $rtt, 
            $philhealth, 
            $others, 
            $landbased, 
            $rehire, 
            $seafarer, 
            $date
        );


        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "InfoSheet.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
        }
        $stmt->close();
        
    } elseif ($_POST['form_action'] === 'confirm_delete' ) {
        $id_to_delete = sanitize_input($_POST['record_id']);
        $delete_sql = "DELETE FROM information_sheet WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        if ($stmt_delete === false) {
            die("Error preparing delete statement: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $id_to_delete);
        if ($stmt_delete->execute()) {
            echo "<div class='info info-success'>Record deleted successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "InfoSheet.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error deleting record: " . $stmt_delete->error . "</div>";
        }
        $stmt_delete->close();
    } else {
        echo "Invalid form action.";
    }
}

?>

                <div class="form-container" <?php if(!isset($_GET["action"])): ?> style="display:none;" <?php endif; ?>>
                    <?php if(isset($_GET["action"]) && $_GET["action"] != "delete"): ?>
                    <h3><?=$form_title?></h3>
                    <form id="household-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">

                        <div class="form-row">
                            <div class="form-col">
                                <label>Date:</label>
                                <input type="date" class="date-picker" name="date"
                                    value="<?= htmlspecialchars(date("Y-m-d", strtotime($data["date"]))) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Male</label>
                                <input type="number" name="male" min="0" value="<?= htmlspecialchars($data['male']) ?>"
                                    required>
                            </div>

                            <div class="form-col">
                                <label>Female</label>
                                <input type="number" name="female" min="0"
                                    value="<?= htmlspecialchars($data['female']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Highest PCT</label>
                                <input type="number" name="highest_pct" min="0"
                                    value="<?= htmlspecialchars($data['highest_pct']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Lowest PCT</label>
                                <input type="number" name="lowest_pct" min="0"
                                    value="<?= htmlspecialchars($data['lowest_pct']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Employment</label>
                                <input type="number" name="employment" min="0"
                                    value="<?= htmlspecialchars($data['employment']) ?>" required>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-col">
                                <label>OWWA</label>
                                <input type="number" name="owwa" min="0" value="<?= htmlspecialchars($data['owwa']) ?>"
                                    required>
                            </div>

                            <div class="form-col">
                                <label>Legal</label>
                                <input type="number" name="legal" min="0"
                                    value="<?= htmlspecialchars($data['legal']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Loan</label>
                                <input type="number" name="loan" min="0" value="<?= htmlspecialchars($data['loan']) ?>"
                                    required>
                            </div>

                            <div class="form-col">
                                <label>Visa</label>
                                <input type="number" name="visa" min="0" value="<?= htmlspecialchars($data['visa']) ?>"
                                    required>
                            </div>

                            <div class="form-col">
                                <label>BM</label>
                                <input type="number" name="bm" min="0" value="<?= htmlspecialchars($data['bm']) ?>"
                                    required>
                            </div>

                            <div class="form-col">
                                <label>RTT</label>
                                <input type="number" name="rtt" min="0" value="<?= htmlspecialchars($data['rtt']) ?>"
                                    required>
                            </div>
                        </div>


                        <div class="form-row">


                            <div class="form-col">
                                <label>Philhealth</label>
                                <input type="number" name="philhealth" min="0"
                                    value="<?= htmlspecialchars($data['philhealth']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Others</label>
                                <input type="number" name="others" min="0"
                                    value="<?= htmlspecialchars($data['others']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Landbased</label>
                                <input type="number" name="landbased" min="0"
                                    value="<?= htmlspecialchars($data['landbased']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Rehire</label>
                                <input type="number" name="rehire" min="0"
                                    value="<?= htmlspecialchars($data['rehire']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Seafarer</label>
                                <input type="number" name="seafarer" min="0"
                                    value="<?= htmlspecialchars($data['seafarer']) ?>" required>
                            </div>

                            <div class="form-col"></div>
                        </div>

                        <div class="form-actions">
                            <a href="InfoSheet.php" class="btn btn-cancel">Cancel</a>
                            <button type="submit"
                                class="btn-submit"><?php echo ($form_action === 'edit') ? 'Update' : 'Submit'; ?></button>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="confirm-delete">
                        <h3>Delete Record</h3>
                        <p><b><?=  htmlspecialchars(date("m/d/Y", strtotime($row["date"]))) ?></b> record will be
                            deleted. Proceed?</p>

                        <form id="Household-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <input type="hidden" name="form_action" value="confirm_delete">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <div class="delete-action">
                                <a href="InfoSheet.php" class="btn btn-cancel">Cancel</a>
                                <button type="submit" class="btn btn-submit-delete">Confirm</button>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="table-container">
                            <?php
            $headers = [
                "No.",
                "Date",
                "Male",
                "Female",
                "Highest PCT",
                "Lowest PCT",
                "Employment",
                "OWWA",
                "Legal",
                "Loan",
                "Visa",
                "BM",
                "RTT",
                "Phil Health",
                "Others",
                "Land Based",
                "Rehire",
                "Seafarer"
            ];
            $data = [];
            $sql = "SELECT * FROM information_sheet ORDER BY created_at DESC";
            $result = $conn->query($sql);
            $offset = 0;
            if ($result->num_rows > 0) {
                $count = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    $d = [ 
                        $count,
                        date("m/d/Y", strtotime($row["date"])), 
                        $row['male'],
                        $row['female'],
                        $row['highest_pct'],
                        $row['lowest_pct'],
                        $row['employment'],
                        $row['owwa'],
                        $row['legal'],
                        $row['loan'],
                        $row['visa'],
                        $row['bm'],
                        $row['rtt'],
                        $row['philhealth'],
                        $row['others'],
                        $row['landbased'],
                        $row['rehire'],
                        $row['seafarer'],
                        $row["id"]
                    ];

                    array_push($data, $d) ;
                    $count++;
                }
            }
            echo generateDataTable( $headers, $data, "No records found", true );

        ?>
                        </div>
                    </div>
                </div>
            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->

<script>
jQuery(function() {
    $(".btn-cancel").on("click", function() {
        $(".form-container").slideToggle();
    });
});
</script>

<?php include("footer.php"); ?>