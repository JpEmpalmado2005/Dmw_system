<?php

if(isset($_POST)){


    if(isset($_POST["action"]) && $_POST["action"] == "critical") {
        $table = "work_resumption";
        $id = $_POST["id"];
        include("db_connect.php");
        $sql_name = "SELECT * FROM $table WHERE id = ?";
        $stmt_name = $conn->prepare($sql_name);
        if ($stmt_name === false) {
           echo json_encode(["error" => "Error preparing statement: " . $conn->error ]);
        }
        $stmt_name->bind_param("i", $id);
        $stmt_name->execute();

        $result_name = $stmt_name->get_result();

        if ($result_name->num_rows === 1) {
            $row = $result_name->fetch_assoc();

            echo json_encode( $row );
        }else{
            echo json_encode(["error" => "No record found."]);
        }
        exit;
    }


    //for viewing data
    if(isset($_POST["action"]) && $_POST["action"] == "view"){
        $table = $_POST["table"];
        $id = $_POST["id"];

        include("db_connect.php");

        $sql_name = "SELECT * FROM $table WHERE id = ?";
        $stmt_name = $conn->prepare($sql_name);
        if ($stmt_name === false) {
           echo json_encode(["error" => "Error preparing statement: " . $conn->error ]);
        }
        $stmt_name->bind_param("i", $id);
        $stmt_name->execute();

        $result_name = $stmt_name->get_result();

        if ($result_name->num_rows === 1) {
            $row = $result_name->fetch_assoc();

            echo json_encode( $row );
        }else{
            echo json_encode(["error" => "No record found."]);
        }
    }

    //create/manage user accounts
    if(isset($_POST["action"]) && $_POST["action"] == "edit"){

    }


    //Approve/Reject Accounts
    if (isset($_POST["action"]) && $_POST["action"] == "approve") {
        include("db_connect.php");

        $id = intval($_POST["id"]); 
        $response = [];

        $update_sql = "UPDATE users SET is_approved = 1 WHERE id = ?";
        $stmt = $conn->prepare($update_sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Fetch the updated user data
                $select_sql = "SELECT id, name, username, email_address, account_type, is_approved FROM users WHERE id = ?";
                $select_stmt = $conn->prepare($select_sql);
                $select_stmt->bind_param("i", $id);
                $select_stmt->execute();
                $result = $select_stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $response = [
                        "status" => "success",
                        "message" => "User approved successfully.",
                        "user" => $result->fetch_assoc()
                    ];
                } else {
                    $response = [
                        "status" => "error",
                        "message" => "User not found after update."
                    ];
                }

                $select_stmt->close();
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Failed to approve user: " . $stmt->error
                ];
            }

            $stmt->close();
        } else {
            $response = [
                "status" => "error",
                "message" => "Failed to prepare statement: " . $conn->error
            ];
        }

        $conn->close();
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    if (isset($_POST["action"]) && $_POST["action"] == "reject") {
        include("db_connect.php");

        $id = intval($_POST["id"]); 
        $response = [];

        $update_sql = "UPDATE users SET is_approved = 3 WHERE id = ?";
        $stmt = $conn->prepare($update_sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Fetch the updated user data
                $select_sql = "SELECT id, name, username, email_address, account_type, is_approved FROM users WHERE id = ?";
                $select_stmt = $conn->prepare($select_sql);
                $select_stmt->bind_param("i", $id);
                $select_stmt->execute();
                $result = $select_stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $response = [
                        "status" => "success",
                        "message" => "User account has been rejected successfully.",
                        "user" => $result->fetch_assoc()
                    ];
                } else {
                    $response = [
                        "status" => "error",
                        "message" => "User not found after update."
                    ];
                }

                $select_stmt->close();
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Failed to reject user: " . $stmt->error
                ];
            }

            $stmt->close();
        } else {
            $response = [
                "status" => "error",
                "message" => "Failed to prepare statement: " . $conn->error
            ];
        }

        $conn->close();
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    exit;

}