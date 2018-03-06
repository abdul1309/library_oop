<?php
require_once 'Classes/session/Session.php';
require_once 'classes/formElement/InputFormElement.php';
require_once 'classes/formElement/ButtonFormElement.php';
require_once 'classes/formElement/SelectFormElement.php';
/**
 * Make object from the class session
 * With the Method @__constarctor in the class session will open the session.
 */
$session = new Session();
$register = new InputFormElement('registrieren', 'register', 'submit', true);
$show_user = new InputFormElement('Benutzer anzeigen', 'show_user', 'submit', true);
$edit_profil = new InputFormElement('ändern mein Profile', 'edit_profil', 'submit', true);
$cancel = new InputFormElement('abbrechen', 'cancel', 'submit', true);
$submit = new InputFormElement('löschen', 'delete', 'submit', true);

