<?php
/**
 * Contact form handler for davidmareshbook.com
 * Sends submissions to the recipients below. Reply-To is set to the visitor.
 */
$recipients = [
    'davidmaresh@msn.com',
    'paul.finch@olympusstoryhouse.com',
];
$from_address = 'noreply@davidmareshbook.com'; // must be on this domain for SiteGround mail delivery
$site_name    = 'davidmareshbook.com';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /contact'); exit; }

function back($ok) { header('Location: /contact?' . ($ok ? 'sent=1' : 'error=1')); exit; }
function clean($s, $max) { $s = trim((string)$s); $s = str_replace(["\r", "\n", "%0a", "%0d"], ' ', $s); return mb_substr($s, 0, $max); }

// Honeypot: bots fill this in, people never see it. Pretend success.
if (!empty($_POST['website'])) { back(true); }

// Simple per-IP throttle: one message per 45 seconds.
$ip   = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$lock = sys_get_temp_dir() . '/dmb_' . md5($ip);
if (is_file($lock) && (time() - filemtime($lock)) < 45) { back(false); }

$name    = clean($_POST['name'] ?? '', 120);
$email   = clean($_POST['email'] ?? '', 160);
$subject = clean($_POST['subject'] ?? '', 160);
$message = trim((string)($_POST['message'] ?? ''));
$message = mb_substr($message, 0, 6000);

if ($name === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { back(false); }

$body  = "New message from the website contact form\n";
$body .= "------------------------------------------\n";
$body .= "Name:    $name\nEmail:   $email\nSubject: $subject\n\nMessage:\n$message\n\n";
$body .= "------------------------------------------\nSent from https://$site_name/contact\n";

$headers  = "From: Dr. Maresh Website <$from_address>\r\n";
$headers .= "Reply-To: $name <$email>\r\n";
$headers .= "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nX-Mailer: PHP/" . phpversion() . "\r\n";

$sent = mail(implode(',', $recipients), '[' . $site_name . '] ' . $subject, $body, $headers, '-f' . $from_address);
if ($sent) { @touch($lock); }
back($sent);
