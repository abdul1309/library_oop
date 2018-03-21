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
$add_book = new InputFormElement('Bücher hinzufügen', 'add_book', 'submit', true);
$show_book = new InputFormElement('Bücher anzeigen', 'show_book', 'submit', true);

//book
$title = new InputFormElement('Title', 'title', 'text', true);
$author = new InputFormElement('Autor', 'author', 'text', true);
$select_category = new SelectFormElement('Kategorie', 'category', true);
$book_into_database = new InputFormElement('send', 'book_into_database', 'submit', true);
$edit_book = new ButtonFormElement('bearbeiten', 'edit_book', 'submit', true);
$send_form_book_edit = new ButtonFormElement('send', 'send_edit_book', 'submit', true);

$lend = new ButtonFormElement('Ausleihen', 'lend', 'submit', true);



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



