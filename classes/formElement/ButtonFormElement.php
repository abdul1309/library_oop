<?php
/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 28.02.18
 * Time: 20:44
 */require_once'FormElement.php';

class ButtonFormElement extends FormElement
{
    /**
     * Get a button element.
     *
     * @return string
     */
    public function render()
    {
        if ($this->mandatory == true) {
            if (!empty($_POST[$this->name])) {
                $value = $_POST[$this->name];
            } elseif (!empty($this->value)) {
                $value = $this->value;
            } else {
                $value = '';
            }
            $get_element = '<button type="submit"  name="' . $this->name . '" value = "' . $value . '">' . $this->label . '</button>';
            return $get_element;
        }
    }
}