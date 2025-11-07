<?php
// Test mail configuration
$mailHost = getenv('MAIL_HOST') ?: $_ENV['MAIL_HOST'] ?? null;
$mailUsername = getenv('MAIL_USERNAME') ?: $_ENV['MAIL_USERNAME'] ?? null;
$devMailHosts = ['mailpit', 'mailhog', 'mailtrap.io', 'sandbox.smtp.mailtrap.io', 'localhost', '127.0.0.1'];

echo "MAIL_HOST: $mailHost\n";
echo "MAIL_USERNAME: $mailUsername\n";
echo "Is empty host: " . (empty($mailHost) ? 'YES' : 'NO') . "\n";
echo "Is empty username: " . (empty($mailUsername) ? 'YES' : 'NO') . "\n";
echo "In dev list: " . (in_array(strtolower($mailHost), $devMailHosts) ? 'YES' : 'NO') . "\n";
echo "Should PASS: " . (!empty($mailHost) && !empty($mailUsername) && !in_array(strtolower($mailHost), $devMailHosts) ? 'YES ✅' : 'NO ❌') . "\n";
