<?php
require_once 'Mail.php';
require_once 'Mail/RFC822.php';

function send_email($to, $from, $subject, $body, $is_body_html = false) {
    if (! valid_email($to)) {
        throw new Exception('This To address is invalid: ' .
                            htmlspecialchars($to));
    }
    if (! valid_email($from)) {
        throw new Exception('This From address is invalid: ' .
                            htmlspecialchars($from));
    }

    $smtp = array();
    // **** You must change the following to match your
    // **** SMTP server and account information.
    $smtp['host'] = 'ssl://smtp.gmail.com';
    $smtp['port'] = 465;
    $smtp['auth'] = true;
    $smtp['username'] = 'example@gmail.com';
    $smtp['password'] = 'supersecret';

    $mailer = Mail::factory('smtp', $smtp);
    if (PEAR::isError($mailer)) {
        throw new Exception('Could not create mailer.');
    }

    // Add the email address to the list of all recipients
    $recipients = array();
    $recipients[] = $to;

    // Set the headers
    $headers = array();
    $headers['From'] = $from;
    $headers['To']  = $to;
    $headers['Subject'] = $subject;
    if ($is_body_html) {
        $headers['Content-type']  = 'text/html';
    }

    // Send the email
    $result = $mailer->send($recipients, $headers, $body);

    // Check the result and throw an error if one exists
    if (PEAR::isError($result)) {
        throw new Exception('Error sending email: ' .
                            htmlspecialchars($result->getMessage()) );
    }
}

function valid_email($email) {
    $emailObjects = Mail_RFC822::parseAddressList($email);
    if (PEAR::isError($emailObjects)) return false;

    // Get the mailbox and host parts of the email object
    $mailbox = $emailObjects[0]->mailbox;
    $host = $emailObjects[0]->host;

    // Make sure the mailbox and host parts aren't too long
    if (strlen($mailbox) > 64) return false;
    if (strlen($host) > 255) return false;

    // Validate the mailbox
    $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
    $dotatom = '(\.' . $atom . ')*';
    $address = '(^' . $atom . $dotatom . '$)';
    $char = '([^\\\\"])';
    $esc  = '(\\\\[\\\\"])';
    $text = '(' . $char . '|' . $esc . ')+';
    $quoted = '(^"' . $text . '"$)';
    $localPart = '/' . $address . '|' . $quoted . '/';
    $localMatch = preg_match($localPart, $mailbox);
    if ($localMatch === false || $localMatch != 1) return false;

    // Validate the host
    $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
    $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
    $top = '\.[[:alnum:]]{2,6}';
    $domainPart = '/^' . $hostnames . $top . '$/';
    $domainMatch = preg_match($domainPart, $host);
    if ($domainMatch === false || $domainMatch != 1) return false;

    return true;
}
?>