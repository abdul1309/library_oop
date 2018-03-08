<?php
require_once 'Classes/session/Session.php';
include 'classes/formElement/InputFormElement.php';
include 'classes/formElement/ButtonFormElement.php';
include 'classes/formElement/SelectFormElement.php';
/**
 * Make object from the class session
 * With the Method @__constarctor in the class session will open the session.
 * Make objects from the classes FormElement.
 * The objects can call anywhere.
 */
$session = new Session();
$show_user = new InputFormElement('Benutzer anzeigen', 'show_user', 'submit', true);
$edit_profil = new InputFormElement('ändern mein Profile', 'edit_profil', 'submit', true);
global $username;
$username = new InputFormElement('Benutzername', 'username', 'text', true);
$password = new InputFormElement('Passwort', 'password', 'password', true);
$password_confirm = new InputFormElement('Passwort beschtätigen', 'password_confirm', 'password', true);
$firstname = new InputFormElement('Vorname', 'firstname', 'text', true);
$lastname = new InputFormElement('Nachname', 'lastname', 'text', true);
$address = new InputFormElement('Adresse', 'address', 'text', true);
$email = new InputFormElement('Email', 'email', 'email', true);
$date_of_birth = new InputFormElement('Geburtsdatum', 'date_of_birth', 'date', true);
$select = new SelectFormElement('Rollen', 'roles', true);
//header
$login = new InputFormElement('Anmelden', 'login', 'submit', true);
$logout = new InputFormElement('Abmelden', 'logout', 'submit', true);
$send_login = new InputFormElement('login', 'login', 'submit', true);
//
$send = new ButtonFormElement('send', 'send', 'submit', true);
$cancel = new InputFormElement('abbrechen', 'cancel', 'submit', true);
$edit = new ButtonFormElement('bearbeiten', 'edit', 'submit', true);
$delete = new InputFormElement('löschen', 'delete', 'submit', true);
//register
$send_register = new InputFormElement('send', 'send_form_register', 'submit', true);



