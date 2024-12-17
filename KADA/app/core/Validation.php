<?php
namespace App\Core;

class Validation
{
    public static function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $value = trim($data[$field] ?? '');
            if ($rule === 'required' && empty($value)) {
                $errors[$field] = ucfirst($field) . " is required.";
            }
            if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "Invalid email format.";
            }
        }
        return $errors;
    }
}
