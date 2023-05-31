<?php 

function do_register(){
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
    render_view('login');
}

function do_not_found(){
    http_response_code(200);
    render_view('not_found');
}