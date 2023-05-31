<?php 

function do_register(){
    if($_POST['person']??false){
        register_post();
    }else{
        register_get();
    }
}

function register_get(){
    render_view('register');
}

function register_post(){
    $validation_errors  = validate_registers($_POST['person']);

    if(count($validation_errors) == 0){

        if(!isset($_POST['person'])){
            return render_view('register');
        }
    
        unset($_POST['person']['password-confirm']);
    
        crud_create($_POST['person']);
    
        header('location: http://localhost:4242/?page=login');
    }else{

        $messages = [
            'validation_errors' => $validation_errors
        ];

        render_view('register', $messages);
    }
}

function do_login(){
    $messages = [];
    switch($_GET['from']){
        case 'register':
            $messages['success'] = "Você ainda precisa confirmar o email!";
        break;
    }
    render_view('login',$messages);
}

function do_not_found(){
    http_response_code(200);
    render_view('not_found');
}