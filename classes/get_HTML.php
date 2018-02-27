<?php

/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 22.02.18
 * Time: 12:04
 */
class Get_HTML
{
    /**
     * Get HTML element label.
     *
     * @param $title      string $title     the title of element will be displayed in a browser.
     * @param $name       string $name      the name of element The name of the control, which is submitted with the form data.
     * @param $mandatory boolean $mandatory for check.
     *
     * @return string
     */
    function label($title, $name, $mandatory)
    {
        if ($mandatory == true) {
            return '<label name = ' . $name . '>' . $title . '</label>';
        }
    }
    /**
     * Get HTML element.
     *
     * @param string  $title     the element´s name will be displayed in a browser.
     * @param string  $name      the element´s The name of the control, which is submitted with the form data.
     * @param string  $type      the elements type.
     * @param boolean $mandatory for check..
     *
     * @return null|string
     */
    function element($title, $name, $type, $mandatory)
    {
        $get_element = null;
        if (!empty($_POST[$name])) {
            $value = $_POST[$name];
        } else {
            $value = '';
        }
        if ($mandatory == 'true') {
            switch ($type) {
            case 'text':
                $get_element = '<input type="text" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '"  >';
                break;
            case 'search':
                $get_element = '<input type="search" name="' . $name . '" value="' . $value . '"  placeholder="' . $title . '">';
                break;
            case 'password':
                $get_element = '<input type="password" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '" >';
                break;
            case 'email':
                $get_element = '<input type="email" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '" >';
                break;
            case 'date':
                $get_element = '<input type="date" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '" >';
                break;
            case 'submit':
                $get_element = '<input type="submit" name="' . $name . '" value="' . $title . '" >';
                break;
            case 'link':
                $get_element = '<a href="' . $name . '" >' . $title . '</a>';
                break;
            case 'button':
                $get_element = '<button type="submit"  name="' . $title . '" value = "' . $value . '">' . $title . '</button>';
                break;
            }
            return $get_element;
        }
    }

    /**
     * Get HTML element.
     *
     * @param string $name  the elements name The name of the control, which is submitted with the form data..
     * @param string $value he elements value.
     * @param string $type  the elements type.
     * @param string $title the element´s name will be displayed in a browser.
     *
     * @return null|string
     */
    function elementValue($name, $value, $type, $title)
    {
        $get_element = null;
        switch ($type) {
        case 'text':
            $get_element = '<input type="text" name="' . $name . '" value="' . $value . '" >';
            break;
        case 'search':
            $get_element = '<input type="search" name="' . $name . '" value="' . $value . '" >';
            break;
        case 'password':
            $get_element = '<input type="password" name="' . $name . '" value="' . $value . '" >';
            break;
        case 'email':
            $get_element = '<input type="email" name="' . $name . '" value="' . $value . '"  >';
            break;
        case 'date':
            $get_element = '<input type="date" name="' . $name . '" value="' . $value . '"  >';
            break;
        case 'button':
            $get_element = '<button type="submit"  name="' . $name . '" value = "' . $value . '">' . $title . '</button>';
            break;
        }
        return $get_element;
    }

    /**
     * Get select Roles
     *
     * @return string
     */
    function selectRoles()
    {
        $get_select = '<select name="Roles">
           <option value=""> new Role</option>
           <option value="2"> admin</option>
           <option value="3">user</option>
        </select>';
        return $get_select;
    }


}