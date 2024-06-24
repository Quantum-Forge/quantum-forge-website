<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $topic = $_POST['topic'];
    $message = $_POST['message'];

    // Format WhatsApp message
    $whatsappMessage = "Name: " . $name . "\n" .
                       "Phone: " . $phone . "\n" .
                       "Topic: " . $topic . "\n" .
                       "-----------------------\n" .
                       "Halo, " . $message . "";

    // WhatsApp number
    $whatsappNumber = '6285163619381';

    // Create WhatsApp URL
    $whatsappURL = "https://wa.me/" . $whatsappNumber . "?text=" . urlencode($whatsappMessage);

    // Redirect to WhatsApp
    header("Location: " . $whatsappURL);
    exit();
}
?>