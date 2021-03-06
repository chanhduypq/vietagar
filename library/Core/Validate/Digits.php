<?php

require_once 'Zend/Validate/Abstract.php';


class Core_Validate_Digits extends Zend_Validate_Abstract
{
    const NOT_DIGITS   = 'notDigits';
    const STRING_EMPTY = 'digitsStringEmpty';
    const INVALID      = 'digitsInvalid';

    /**
     * Digits filter used for validation
     *
     * @var Zend_Filter_Digits
     */
    protected static $_filter = null;

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = array(
        self::NOT_DIGITS   => "'%value%' không phải là các chữ số.",
        self::STRING_EMPTY => "'%value%' không được rỗng.",
        self::INVALID      => "Phải nhập bằng các chữ số.",
    );

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if $value only contains digit characters
     *
     * @param  string $value
     * @return boolean
     */
    public function isValid($value)
    {
        if (!is_string($value) && !is_int($value) && !is_float($value)) {
            $this->_error(self::INVALID);
            return false;
        }

        $this->_setValue((string) $value);

        if ('' === $this->_value) {
            $this->_error(self::STRING_EMPTY);
            return false;
        }

        if (null === self::$_filter) {
            require_once 'Zend/Filter/Digits.php';
            self::$_filter = new Zend_Filter_Digits();
        }

        if ($this->_value !== self::$_filter->filter($this->_value)) {
            $this->_error(self::NOT_DIGITS);
            return false;
        }

        return true;
    }
}
