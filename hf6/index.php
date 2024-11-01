<?php

$errors = [];
$fileOk = 1;

$firstname = $_POST["firstName"] ?? '';
$lastname = $_POST["lastName"] ?? '';
$email = $_POST["email"] ?? '';
$attend = $_POST["attend"] ?? [];
$tshirt = $_POST["tshirt"] ?? 'P';
$terms = isset($_POST['terms']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
}

?>

<h3>Online conference registration</h3>

<form method="post" action="index.php" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?= $firstname ?? '' ?>">
    </label>
    <span style="color: red"><?= $errors['fname'] ?? '' ?></span>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?= $lastname ?? '' ?>">
    </label>
    <span style="color: red"><?= $errors['lname'] ?? '' ?></span>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email" value="<?= $email ?? '' ?>">
    </label>
    <span style="color: red"><?= $errors['email'] ?? '' ?></span>
    <br><br>
    <label for="attend"> I will attend:<br>
        <input type="checkbox" name="attend[]" value="Event1" 
        <?php if (isset($attend) && in_array('Event1', $attend)) echo 'checked'; ?>>Event1<br>
        <input type="checkbox" name="attend[]" value="Event2" 
        <?php if (isset($attend) && in_array('Event2', $attend)) echo 'checked'; ?>>Event2<br>
        <input type="checkbox" name="attend[]" value="Event3" 
        <?php if (isset($attend) && in_array('Event3', $attend)) echo 'checked'; ?>>Event3<br>
        <input type="checkbox" name="attend[]" value="Event4" 
        <?php if (isset($attend) && in_array('Event4', $attend)) echo 'checked'; ?>>Event4<br>
    </label>
    <span style="color: red"><?= $errors['attend'] ?? '' ?></span>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt">
            <option value="P">Please select</option>
            <option value="S" <?php if (isset($tshirt) && $tshirt == 'S') echo 'selected'; ?>>S</option>
            <option value="M" <?php if (isset($tshirt) && $tshirt == 'M') echo 'selected'; ?>>M</option>
            <option value="L" <?php if (isset($tshirt) && $tshirt == 'L') echo 'selected'; ?>>L</option>
            <option value="XL" <?php if (isset($tshirt) && $tshirt == 'XL') echo 'selected'; ?>>XL</option>
        </select>
    </label>
    <span style="color: red"><?= $errors['tshirt'] ?? '' ?></span>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract"/>
        <span style="color: red"><?= $errors['fileNotSet'] ?? '' ?></span>
        <span style="color: red"><?= $errors['fileType'] ?? '' ?></span>
        <span style="color: red"><?= $errors['fileSize'] ?? '' ?></span>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="" 
    <?php if (!empty($terms)) echo 'checked'; ?>>I agree to terms & conditions.<br>
    <span style="color: red"><?= $errors['terms'] ?? '' ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>
</form>