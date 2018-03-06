<?php
/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 27.02.18
 * Time: 16:33
 */
class FormElement
{
    public $label;
    public $name;
    public $mandatory;
    public $value;

    /**
     * FormElement constructor.
     *
     * @param $label string      $label     the title of element will be displayed in a browser.
     * @param $name string       $name      the   title of element will be displayed in a browser.
     * @param $mandatory boolean $mandatory for check.
     *
     * @return set values
     */
    public function __construct($label, $name, $mandatory)
    {
        $this->label = $label;
        $this->name = $name;
        $this->mandatory = $mandatory;
    }

    /**
     * Set values.
     *
     * @param $values mixed $values the elements values will be.
     *
     * @return set anew values.
     */
    public function setValue($values)
    {
        $this->value = $values;
    }

    /**
     * Label element.
     *
     * @return string
     */
    public function renderLabel()
    {
        return '<p><label name = ' . $this->name . '>' . $this->label . '</label></p>';
    }
}