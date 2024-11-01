<?php

$errors = [];
$fileOk = 1;

$firstname = $_POST["firstName"] ?? '';
$lastname = $_POST["lastName"] ?? '';
$email = $_POST["email"] ?? '';
$attend = $_POST["attend"] ?? [];
$tshirt = $_POST["tshirt"] ?? 'P';
$terms = isset($_POST['terms']);

if (empty($firstname)) $errors['fname'] = "First Name is required";
if (empty($lastname)) $errors['lname'] = "Last Name is required";
if (empty($email)) $errors['email'] = "E-mail is required";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid e-mail adress";
    $email = '';
}
if (empty($attend)) $errors['attend'] = "Selecting at least one event is required";
if ($tshirt == 'P') $errors['tshirt'] = "Selecting a t-shirt size is required";
if (empty($terms)) $errors['terms'] = "Accepting Terms & Conditions is required";
if ($_FILES['abstract']['error'] != 0) {
    $fileOk = 0;
    $errors['fileNotSet'] = "Uploading a file is required. ";
}
else {
    $fileType = strtolower(pathinfo($_FILES['abstract']['name'], PATHINFO_EXTENSION));
    if ($fileType != 'pdf') {
        $fileOk = 0;
        $errors['fileType'] = "Only PDF files are allowed. ";
    }
    if ($_FILES['abstract']['size'] > 3 * 1024 * 1024) {
        $fileOk = 0;
        $errors['fileSize'] = "Max file size is 3MB. ";
    }
}

if ($fileOk) {
    move_uploaded_file($_FILES['abstract']['tmp_name'], 'uploads/' . basename($_FILES['abstract']['name']));
}

if (empty($errors)) {
    echo "First Name: $firstname<br>";
    echo "Last Name: $lastname<br>";
    echo "E-mail: $email<br>";
    echo "Attendance: " . implode(', ', $attend) . '<br>';
    echo "T-shirt: $tshirt<br>";
    echo basename($_FILES['abstract']['name']) . ' uploaded succesfully<br>';

    $firstname = '';
    $lastname = '';
    $email = '';
    $attend = [];
    $tshirt = 'P';
    $terms = '';
}
else {
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
}

echo '<br>';

echo "<a href='index.php'>vissza</a>";