<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Mengatur nomor WhatsApp tujuan
    $whatsapp_number = '6285163619381';
    
    // Membuat pesan yang akan dikirim
    $whatsapp_message = "Name: $name\nEmail: $email\nSubject: $subject\n-----------------------\nHalo, $message";
    
    // Membuat URL WhatsApp dengan pesan
    $whatsapp_url = "https://api.whatsapp.com/send?phone=$whatsapp_number&text=" . urlencode($whatsapp_message);
    
    // Redirect ke URL WhatsApp
    header("Location: $whatsapp_url");
    exit();
} else {
    echo "Invalid Request Method";
}
?>
