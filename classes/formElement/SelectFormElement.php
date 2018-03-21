<?php
/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 28.02.18
 * Time: 20:40
 */
require_once'FormElement.php';
/**
 * Class SelectFormElement
 */
class SelectFormElement extends FormElement
{
    /**
     * Get a select element.
     *
     * @return string
     */
    public function render()
    {
        $options = null;
        $get_element_select = '<select name="' . $this->name . '" >';
        foreach ($this->value as $this->value) {
            foreach ($this->value as $value => $row) {
                if (!empty($_POST[$this->name])) {
                    $select = ' selected="selected"';
                } else {
                    $select = '';
                }
                if ($this->value!= $this->value) {

                }

                $option[] = '<option value="' . $value . '"' . $select . '>' . $row . '</option>';
                $options = implode(PHP_EOL, $option);
            }
        }

        return $this->renderLabel(). $get_element_select . $options . '</select>';
    }

}
