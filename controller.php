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

        $_POST['person']['mail_validation'] = false;

        unset($_POST['person']['password-confirm']);
    
        crud_create($_POST['person']);

        $email = $_POST['person']['email'];

        $hash = ssl_crypt($email);

        $url = APP_URL."?page=mail-validation&token=".$hash;

        send_mail($email,"Ative a conta",$url);    

        header("Location: /?page=login&from=register");
    }else{

        $messages = [
            'validation_errors' => $validation_errors
        ];

        render_view('register', $messages);
    }
}

function do_login(){
    $messages = [];
    switch(isset($_GET['from'])){
        case 'register':
            $messages['success'] = "Você ainda precisa confirmar o email!";
        break;
    }
    render_view('login',$messages);
}

function mail_validation(){
    echo $_GET['token'];
}

function do_not_found(){
    http_response_code(200);
    render_view('not_found');
}