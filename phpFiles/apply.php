<!DOCTYPE html>
<html lang="">
<head>
    <title>Educational registration form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        html, body {
            min-height: 100%;
        }
        body, div, form, input, select{
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 16px;
            color: #eee;
        }
        body {
            background: url("../imgFiles/forma.jpg") no-repeat center;
            background-size: cover;
        }
        h1, h2 {
            text-transform: uppercase;
            font-weight: 400;
        }
        h2 {
            margin: 0 0 0 8px;
        }
        .main-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 25px;
            background: rgba(0, 0, 0, 0.5);
        }
        form {
            background: rgba(0, 0, 0, 0.7);
        }
        .title {
              display: flex;
              align-items: center;
              margin-bottom: 20px;
          }
        .info {
            display: flex;
            flex-direction: column;
        }
        input, select {
            padding: 5px;
            margin-bottom: 30px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #eee;
        }
        input::placeholder {
            color: #eee;
        }
        option:focus {
            border: none;
        }
        option {
            background: black;
            border: none;
        }
        .checkbox input {
            margin: 0 10px 0 0;
            vertical-align: middle;
        }
        .checkbox a {
            color: #26a9e0;
        }
        .checkbox a:hover {
            color: #85d6de;
        }
        .btn-item, button {
            padding: 10px 5px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            background: #26a9e0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            color: #fff;
        }
        .btn-item {
            display: inline-block;
            margin: 20px 5px 0;
        }
        button {
            width: 100%;
        }
        button:hover, .btn-item:hover {
            background: #85d6de;
        }
        @media (min-width: 568px) {
            html, body {
                height: 100%;
            }
            .main-block {
                flex-direction: row;
                height: calc(100% - 50px);
            }
        }
        .href{
            font-size: 18px;
            color: white;
            margin-left: 40%;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="main-block">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="title">
            <span class="span"></span>
            <h2>Please fill in order to apply</h2>
        </div>
        <div class="info">
            <input type="text" name="name" placeholder="Full name">
            <input type="text" name="lName" placeholder="Last name">
            <input type="text" name="age" placeholder="Age">
            <input type="text" name="instructor" placeholder="Instructor">
            <textarea name="comment"></textarea>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="checkbox"><span>I agree to the <a href="#">Privacy Policy.</a></span>
        </div>
        <button type="submit" href="/">Submit</button>
        <a class="href" href="../htmlFiles/main.html">Homepage</a>
</div>
    </form>
</div>

</body>
</html>
<?php
require_once "config.php";

$name = $lName = $age = $instructor = $comment = "";
$name_err = $lName_err = $age_err = $instructor_err = $comment_err = "";

//IME
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } elseif (!preg_match('/^[A-Z][a-z]*$/', trim($_POST["name"]))) {
        $name_err = "Name can only contain letters.";
    } else {
        $sql = "INSERT INTO applier (name) VALUES (?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            $param_name = trim($_POST["name"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $name = trim($_POST["name"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
//PREZIME
    if (empty(trim($_POST["lName"]))) {
        $lName_err = "Please enter a last name.";
    } elseif (!preg_match('/^[A-Z][a-z]*$/', trim($_POST["lName"]))) {
        $lName_err = "Last name can only contain letters.";
    } else {
        $sql = "INSERT INTO applier (surname ) VALUES (?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_lName);
            $param_lName = trim($_POST["lName"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $lName = trim($_POST["lName"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
//GODINE
    if (empty(trim($_POST["age"]))) {
        $age_err = "Please enter your age.";
    } elseif (!preg_match('/^[0-9]{1,3}$/', trim($_POST["age"]))) {
        $age_err = "Age can only contain numbers.";
    } else {
        $sql = "INSERT INTO applier (age) VALUES (?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_age);
            $param_age = trim($_POST["age"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $age = trim($_POST["age"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
//INSTRUKTOR
    if (empty(trim($_POST["instructor"]))) {
        $instructor_err = "Please enter a instructor name.";
    } elseif (!preg_match('/^[A-Z][a-z]*$/', trim($_POST["instructor"]))) {
        $instructor_err = "Instructor can only contain letters.";
    } else {
        $sql = "INSERT INTO applier (teacher_name) VALUES (?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_instructor);
            $param_instructor = trim($_POST["instructor"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $instructor = trim($_POST["instructor"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
//KOMENTAR
    if (empty(trim($_POST["comment"]))) {
        $comment_err = "Please enter a comment";
    } elseif (!preg_match('/^[A-Z][a-z]*$/', trim($_POST["comment"]))) {
        $comment_err = "comment can only contain letters.";
    } else {
        $sql = "INSERT INTO applier (comment) VALUES (?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_comment);
            $param_comment = trim($_POST["comment"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $comment = trim($_POST["comment"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
    //FINISH
if($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssiss", $param_name, $param_lName, $param_age, $param_instructor, $param_comment);

    // Set parameters
    $param_name = $name;
    $param_lName = $lName;
    $param_age = $age;
    $param_instructor = $instructor;
    $param_comment = $comment;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to login page
        header("location: login.php");
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    mysqli_close($link);
}
}
?>
