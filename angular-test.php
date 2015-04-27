<?php
/**
 * zadanie rekrutacyjne
 */
$user = $_POST;

//$user = array(
//    'firstName'     =>'Piotr',
//    'lastName'      =>'Błaszczak',
//    'email'         =>'piotr.blaszczak@nf.pl',
//    'position'      =>'JS&&PHP Developer',
//    'phone'         =>'555666999',
//    'dateOfBirth'   =>'01-01-1983',
//    'selfEmployed'  =>'1',
//    'experience'    =>array(
//        array(
//            'companyName'=>'Nowoczesna Firma',
//            'duration'=>'1 rok'
//        ),
//        array(
//            'companyName'=>'Software Focus',
//            'duration'=>'1,5 roku'
//        ),
//    )
//);

$fields = array(
    'firstName',
    'lastName',
    'email',
    'position',
    'phone',
    'dateOfBirth',
//    'selfEmployed',
);
$errors = array();

foreach($fields as $f) {
    if(!isset($user[$f]) OR !$user[$f]) {
        $errors[$f] = 'To pole jest wymagane';
    }
}
if(isset($user['experience']) and $user['experience']) {
    if(is_array($user['experience'])){
        foreach($user['experience'] as $e) {
            if(!isset($e['companyName']) OR !isset($e['duration'])) {
                $errors['experience'] = 'Obiekty pola experience muszą składać się z companyName oraz duration';
            }
        }
    } else {
        $errors['experience'] = 'To pole musi być puste lub być tablicą obiektów';
    }
}

header('Content-Type: application/json');
if(count($errors)) {
    header( 'HTTP/1.1 400 BAD REQUEST' );
    echo json_encode(array(
        'message'=>'Błędne dane',
        'errors'=>$errors
    ));
} else {
    echo json_encode(array(
        'message'=>'Poprawne dane',
        'user'=>$user
    ));

}
