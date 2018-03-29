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
$showUserForm = new InputFormElement('Benutzer anzeigen', 'show_user', 'submit', true);
$editProfilForm = new InputFormElement('Ändern mein Profile', 'edit_profil', 'submit', true);
$addBookForm = new InputFormElement('Bücher hinzufügen', 'add_book', 'submit', true);
$showBookForm = new InputFormElement('Bücher anzeigen', 'show_book', 'submit', true);
//book
$titleBookForm = new InputFormElement('Title', 'title', 'text', true);
$authorForm = new InputFormElement('Autor', 'author', 'text', true);
$ibanForm = new InputFormElement('IBAN', 'iban', 'text', true);
$number = new InputFormElement('Anzahl', 'number', 'text', true);
$idBookForm = new ButtonFormElement('id Buch', 'id_book', 'submit', true);
$BookFormBookToD = new ButtonFormElement('Zurück geben', 'BookFormBookToD', 'submit', true);

$selectCategoryForm = new SelectFormElement('Kategorie', 'category', true);
$bookIntoDatabaseForm = new InputFormElement('send', 'book_into_database', 'submit', true);
$editBookForm = new ButtonFormElement('bearbeiten', 'edit_book', 'submit', true);
$sendFormBookEdit = new ButtonFormElement('send', 'send_edit_book', 'submit', true);
$lendBookForm = new ButtonFormElement('Ausleihen', 'lend_book_form', 'submit', true);
$BookFormToDatabase = new InputFormElement('Meine Bücher', 'my_books', 'submit', true);
global $usernameForm;
$usernameForm= new InputFormElement('Benutzername', 'username', 'text', true);
$passwordForm = new InputFormElement('Passwort', 'password', 'password', true);
$passwordConfirmForm = new InputFormElement('Passwort beschtätigen', 'password_confirm', 'password', true);
$firstnameForm = new InputFormElement('Vorname', 'firstname', 'text', true);
$lastnameForm = new InputFormElement('Nachname', 'lastname', 'text', true);
$adressForm = new InputFormElement('Adresse', 'address', 'text', true);
$emailForm = new InputFormElement('Email', 'email', 'email', true);
$dateOfBirthForm = new InputFormElement('Geburtsdatum', 'date_of_birth', 'date', true);
$selectRolesForm = new SelectFormElement('Rollen', 'roles', true);
//header
$loginForm = new InputFormElement('Anmelden', 'login', 'submit', true);
$logoutForm = new InputFormElement('Abmelden', 'logout', 'submit', true);
$sendLoginForm= new InputFormElement('login', 'login', 'submit', true);
//
$sendForm = new ButtonFormElement('send', 'send', 'submit', true);
$cancelForm = new InputFormElement('abbrechen', 'cancel', 'submit', true);
$editForm = new ButtonFormElement('bearbeiten', 'edit', 'submit', true);
$deleteForm = new InputFormElement('löschen', 'delete', 'submit', true);
//register
$sendRegisterForm = new InputFormElement('send', 'send_form_register', 'submit', true);



