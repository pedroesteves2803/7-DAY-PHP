<?php 

function render_view($template, $messages = []){
    $content = load_content($template, $messages);
    echo $content;
}

function load_content($template, $messages) {
    $content = file_get_contents(VIEW_FOLDER.$template.'.view');
    $msg = "<span class='mensagem-erro'>Mensagem de Erro</span>";
    $content = str_replace('{{teste}}',$msg,$content);
    echo($content);
    // foreach($messages as $message){
    //     print_r($message);
    //     echo "<br>";
    // }
}