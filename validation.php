<?php

function validate_registers($data) {
    $errors = [];

    if(strlen($data['password']) < 8) {
        $errors['password'] = 'Senha deve ser maior que 8 caracteres.';
    }

    if($data['password'] !== $data['password-confirm']) {
        $errors['password-confirm'] = 'Senha deve ser maior que 8 caracteres.';
    }
    
    if(crud_restore($data['email'])){
        $errors['email'] = 'Email já cadastrado.';
    };

    return $errors;
}