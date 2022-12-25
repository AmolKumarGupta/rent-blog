<?php
namespace RentBlog\Rules;

class Rule
{
    public function phone_number_or_empty (string $str, ?string $error) {
        $str = trim($str);
        if ($str == '') {
            return TRUE;

        }else {
            if (preg_match('/^[0-9]{10}$/', $str)) {
                return TRUE;
            } else {
                $error = "invalid phone number";
                return FALSE;
            }
        }
    }
}
?>