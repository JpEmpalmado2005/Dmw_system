<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="css/login.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    
</head>
<body>
<?php
    include("db_connect.php");

    if(!empty($_SESSION["logged_in"])){
        header("Location: Dashboard.php");
    }
    
    $error = "";

    if(isset($_POST["login"])){

        $user = $_POST["username"];
        $pass = $_POST["password"];
       
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param ("ss", $user, $pass); 
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if(isset($user["is_approved"]) && $user["is_approved"] == 1){
                $_SESSION["logged_in"] = true; 
                $_SESSION["user_id"] = $user["id"];
                header("Location: Dashboard.php");
                exit();
            }elseif(isset($user["is_approved"]) && $user["is_approved"] == 0){
                $error = "Your account is awaiting approval, please contact admin.";
            }elseif(isset($user["is_approved"]) && $user["is_approved"] == 3){
                $error = "Access denied, please contact admin.";
            }
        } else {
            $error = "Invalid username and password.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
   <div id="myModal" class="modal">
                    
        <div class="modal-content" >
            <span class="close">&times;</span>
            <p></p>
            
            <label class="checkbox-wrapper"> 
                <input type="checkbox" />
                <div class="checkmark" >
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"  >
                    <path
                      d="M20 6L9 17L4 12"
                      stroke-width="3"
                      stroke-linecap="round"
                      stroke-linejoin="round" 
                    ></path>
                  </svg>
                </div>
        </div>
    </div>
    <div class="background-overlay"></div>
    
    <div class="left-panel">
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo" class="logo">
        </div>
        <div class="department-info">
            <div class="department-title">Department of Migrant Workers</div>
            <div class="division-name">Migrant Workers Processing Division <br>System</div>
            <div class="system-name"></div>
        </div>
       
    </div>

    <div class="login-container">
        
        <div class="login-header">
            <h2>LOGIN</h2>
            <p>Welcome back! Please login to your account.</p>
            <?php if(!empty($error)) : ?>
                <div class="error"><?=$error?></div>
            <?php endif; ?>
        </div>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>
           
    
            <div class="forgot-password">
                <span class="clickable-text" id="popupText">Terms & Conditions</span>
                
            </div>
                
              </label>
            <button type="submit" id="btn" value="login" name="login" class="submit-btn">SUBMIT</button>
        </form>
    </div>
    <script>
        const modal = document.getElementById("myModal");
        const text = document.getElementById("popupText");
        const span = document.getElementsByClassName("close")[0];
        
        text.onclick = function() {
            modal.style.display = "block";
        }
        
    
        span.onclick = function() {
            modal.style.display = "none";
        }
        
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>