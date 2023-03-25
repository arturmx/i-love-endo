<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes\Front;

/**
 * Description of FormValidator
 *
 * @author home
 */
class FormValidator {
    
    /**
     * Errors list
     *
     * @var array
     */
    private $errors;


    /**
     * FormValidator constructor.
     */
    public function __construct()
    {
        $this->errors = array();
    }


    /**
     * Add field to validator
     *
     * @param string $field
     * @param mixed $value
     * @param array $arguments (required, email, phone, min:val, max:val)
     */
    public function addField ($field, $value, $arguments)
    {
        foreach ($arguments as $key => $argument) {
            $valid = true;

            if (is_int($key) && method_exists($this, $argument)) {
                $valid = $this->{$argument} ($field, $value);
            } elseif (method_exists($this, $key)) {
                $valid = $this->{$key} ($field, $value, $argument);
            }

            if ($valid === false) { break; }
        }
    }


    /**
     * Required validation
     *
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    private function required ($field, $value)
    {
        if ($value && !empty($value)) {
            return true;
        }

        $this->errors[$field] = $this->getErrorMessage('required');
        return false;
    }


    /**
     * E-mail address validation
     *
     * @param string $field
     * @param string $value
     * @return bool
     */
    private function email ($field, $value)
    {
        $email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if (strlen($value) < 1 || preg_match($email_regex, $value)) {
            return true;
        }

        $this->errors[$field] = $this->getErrorMessage('email');
        return false;
    }

    
    /**
     * Phone number validation
     *
     * @param string $field
     * @param string $value
     * @return bool
     */
    private function phone ($field, $value)
    {
        $phone_numeric = preg_replace("/[^0-9]/", '', $value);

        // phone number
        if (strlen($value) < 1 || (strlen($phone_numeric) > 7 && strlen($phone_numeric) < 15)) {
            return true;
        }

        $this->errors[$field] = $this->getErrorMessage('phone');
        return false;
    }
    

    /**
     * Min validation
     *
     * @param string $field
     * @param string|array $value
     * @param array $argument
     * @return bool
     */
    private function min ($field, $value, $argument)
    {
        // string
        if (is_string($value) && strlen($value) < $argument && strlen($value) > 0) {
            $this->errors[$field] = $this->getErrorMessage('min_str') . ' ' . $argument;
        }

        // array
        elseif (is_array($value) && count($value) < $argument) {
            $this->errors[$field] = $this->getErrorMessage('min_array') . ' ' .$argument;
        }

        return true;
    }


    /**
     * Max validation
     *
     * @param string $field
     * @param string|array $value
     * @param array $argument
     * @return bool
     */
    private function max ($field, $value, $argument)
    {
        // string
        if (is_string($value) && strlen($value) > $argument) {
            $this->errors[$field] = $this->getErrorMessage('max_str') . ' ' . $argument;
        }

        // array
        elseif (is_array($value) && count($value) > $argument) {
            $this->errors[$field] = $this->getErrorMessage('max_array') . ' ' .$argument;
        }

        return true;
    }


    /**
     * Get errors list
     *
     * @return array
     */
    public function getErrors ()
    {
        return $this->errors;
    }


    /**
     * Get Error message by KEY
     *
     * @param string $key
     * @return string
     */
    private function getErrorMessage ($key)
    {
        $messages = array (
            'required'  => 'To pole jest wymagane',
            'email'     => 'Niepoprawny adres E-mail',
            'min_str'   => 'Minimalna liczba znaków:',
            'min_array' => 'Minimalna liczba elementów:',
            'max_str'   => 'Maksymalna liczba znaków:',
            'max_array' => 'Maksymalna liczba elementów:',
            'phone'     => 'Niepoprawny numer telefonu'
        );

        return $messages[$key];
    }
    
}
