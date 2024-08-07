<?php
require_once 'lib/rb-mysql.php';

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$phonenumber = $_POST['phonenumber'];

R::setup('mysql:host=localhost;dbname=k64078g4_2010',  'k64078g4_2010', 'masakov_2010');

if (!R::testConnection()) {
    exit('Нет подключение с  базой данных');
}

$user = R::count('users', 'login = ?', array($login));

if ($user == 0) {
    $user = R::dispense('users');
    $user->login = $login;
    $user->email = $email;
    $user->password = password_hash($password, PASSWORD_DEFAULT) ;
    $user->phonenumber = $phonenumber;
    R::store($user);
    echo 'Вы успешно зарегистрировались';

}
else {
    echo 'Пользователь с таким логином уже существует';
}

?>