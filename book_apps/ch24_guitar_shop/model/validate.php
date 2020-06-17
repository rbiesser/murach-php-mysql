<?php
class Validate {
    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field
    public function text($name, $value,
            $required = true, $min = 1, $max = 255) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }

    // Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message,
            $required = true) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ( $match != 1 ) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function phone($name, $value, $required = false) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Call the pattern method to validate a phone number
        $pattern = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
        $message = 'Invalid phone number.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Split email address on @ sign and check parts
        $parts = explode('@', $value);
        if (count($parts) < 2) {
            $field->setErrorMessage('At sign required.');
            return;
        }
        if (count($parts) > 2) {
            $field->setErrorMessage('Only one at sign allowed.');
            return;
        }
        $local = $parts[0];
        $domain = $parts[1];

        // Check lengths of local and domain parts
        if (strlen($local) > 64) {
            $field->setErrorMessage('Username part too long.');
            return;
        }
        if (strlen($domain) > 255) {
            $field->setErrorMessage('Domain name part too long.');
            return;
        }

        // Patterns for address formatted local part
        $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
        $dotatom = '(\.' . $atom . ')*';
        $address = '(^' . $atom . $dotatom . '$)';

        // Patterns for quoted text formatted local part
        $char = '([^\\\\"])';
        $esc  = '(\\\\[\\\\"])';
        $text = '(' . $char . '|' . $esc . ')+';
        $quoted = '(^"' . $text . '"$)';

        // Combined pattern for testing local part
        $localPattern = '/' . $address . '|' . $quoted . '/';

        // Call the pattern method and exit if it yields an error
        $this->pattern($name, $local, $localPattern,
                'Invalid username part.');
        if ($field->hasError()) { return; }

        // Patterns for domain part
        $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
        $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
        $top = '\.[[:alnum:]]{2,6}';
        $domainPattern = '/^' . $hostnames . $top . '$/';

        // Call the pattern method
        $this->pattern($name, $domain, $domainPattern,
                'Invalid domain name part.');
    }

    public function password($name, $password, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($password)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $password, $required, 6);
        if ($field->hasError()) { return; }

        // Patterns to validate password
        $charClasses = array();
        $charClasses[] = '[:digit:]';
        $charClasses[] = '[:upper:]';
        $charClasses[] = '[:lower:]';

        $pw = '/^';
        $valid = '[';
        foreach($charClasses as $charClass) {
            $pw .= '(?=.*[' . $charClass . '])';
            $valid .= $charClass;
        }
        $valid .= ']{6,}';
        $pw .= $valid . '$/';

        $pwMatch = preg_match($pw, $password);

        if ($pwMatch === false) {
            $field->setErrorMessage('Error testing password.');
            return;
        } else if ($pwMatch != 1) {
            $field->setErrorMessage(
                    'Must have one each of upper, lower, and digit.');
            return;
        }
    }

    public function verify($name, $password, $verify, $required = true) {
        $field = $this->fields->getField($name);
        $this->text($name, $verify, $required, 6);
        if ($field->hasError()) { return; }

        if (strcmp($password, $verify) != 0) {
            $field->setErrorMessage('Passwords do not match.');
            return;
        }
    }

    public function state($name, $value, $required = true) {
        $field = $this->fields->getField($name);
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        $states = array(
            'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC',
            'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY',
            'LA', 'ME', 'MA', 'MD', 'MI', 'MN', 'MS', 'MO', 'MT',
            'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH',
            'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT',
            'VT', 'VA', 'WA', 'WV', 'WI', 'WY');
        $states = implode('|', $states);
        $pattern = '/^(' . $states . ')$/';
        $this->pattern($name, $value, $pattern,
                'Invalid state.', $required);
    }

    public function zip($name, $value, $required = true) {
        $field = $this->fields->getField($name);
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        $pattern = '/^[[:digit:]]{5}(-[[:digit:]]{4})?$/';
        $message = 'Invalid zip code.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function cardType($name, $value) {
        $field = $this->fields->getField($name);
        if (empty($value)) {
            $field->setErrorMessage('Please select a card type.');
            return;
        }
        $types = array();
        $types[] = 'm';
        $types[] = 'v';
        $types[] = 'a';
        $types[] = 'd';
        $types = implode('|', $types);
        $pattern = '/^(' . $types . ')$/';
        $this->pattern($name, $value, $pattern, 'Invalid card type.');
    }

    public function cardNumber($name, $value, $type) {
        $field = $this->fields->getField($name);
        switch ($type) {
            case 'm':  // MasterCard
                $prefixes = '51-55';
                $lengths  = '16';
                break;
            case 'v':  // Visa
                $prefixes = '4';
                $lengths  = '13,16';
                break;
            case 'a':  // American Express
                $prefixes = '34,37';
                $lengths  = '15';
                break;
            case 'd':  // Discover
                $prefixes = '6011,622126-622925,644-649,65';
                $lengths  = '16';
                break;
            case '':   // No card type selected.
                $field->clearErrorMessage();
                return;
            default:
                $field->setErrorMessage('Invalid card type.');
                return;
        }
        // Check lengths
        $lengths = explode(',', $lengths);
        $validLengths = false;
        foreach($lengths as $length) {
            $pattern = '/^[[:digit:]]{' . $length . '}$/';
            if (preg_match($pattern, $value) === 1) {
                $validLengths = true;
                break;
            }
        }
        if ( ! $validLengths ) {
            $field->setErrorMessage('Invalid card number length.');
            return;
        }
        // Check prefix
        $prefixes = explode(',', $prefixes);
        $rangePattern = '/^[[:digit:]]+-[[:digit:]]+$/';
        $validPrefix = false;
        foreach($prefixes as $prefix) {
            if (preg_match($rangePattern, $prefix) === 1) {
                $range = explode('-', $prefix);
                $start = intval($range[0]);
                $end = intval($range[1]);
                for( $prefix = $start; $prefix <= $end; $prefix++ ) {
                    $pattern = '/^' . $prefix . '/';
                    if (preg_match($pattern, $value) === 1) {
                        $validPrefix = true;
                        break;
                    }
                }
            } else {
                $pattern = '/^' . $prefix . '/';
                if (preg_match($pattern, $value) === 1) {
                    $validPrefix = true;
                    break;
                }
            }
        }
        if ( ! $validPrefix ) {
            $field->setErrorMessage('Invalid card number prefix.');
            return;
        }
        // Validate checksum
        $sum = 0;
        $length = strlen($value);
        for ($i = 0; $i < $length; $i++) {
            $digit = intval($value[$length - $i - 1]);
            $digit = ( $i % 2 == 1 ) ? $digit * 2 : $digit;
            $digit = ($digit > 9) ? $digit - 9 : $digit;
            $sum += $digit;
        }
        if ( $sum % 10 != 0 ) {
            $field->setErrorMessage('Invalid card number checksum.');
            return;
        }
        $field->clearErrorMessage();
    }

    public function expDate($name, $value) {
        $field = $this->fields->getField($name);
        $datePattern = '/^(0[1-9]|1[012])\/[1-9][[:digit:]]{3}?$/';
        $match = preg_match($datePattern, $value);
        if ( $match === false ) {
            $field->setErrorMessage('Error testing field.');
            return;
        }
        if ( $match != 1 ) {
            $field->setErrorMessage('Invalid date format.');
            return;
        }
        $dateParts = explode('/', $value);
        $month = $dateParts[0];
        $year  = $dateParts[1];
        $dateString = $month . '/01/' . $year . ' last day of 23:59:59';
        $exp = new DateTime($dateString);
        $now = new DateTime();
        if ( $exp < $now ) {
            $field->setErrorMessage('Card has expired.');
            return;
        }
        $field->clearErrorMessage();
    }

}
?>