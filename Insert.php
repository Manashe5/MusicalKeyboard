<?php
$conn = mysqli_connect("localhost", "root", "", "sample");

if ($conn) {
    printf("done");
}

if (isset($_POST['submit'])) {
    $Name = $_POST['Sname'];
    $Email = $_POST['Semail'];
    $Ph_no = $_POST['phone'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contact (Name, Email, Phone_Number, Subject, Message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $Name, $Email, $Ph_no, $subject, $msg);

    if ($stmt->execute()) {
        echo "Your contact information is saved successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    header('Location: Contact.html');
    exit();  // Make sure to call exit() after header() to stop execution
}

mysqli_close($conn);
?>
