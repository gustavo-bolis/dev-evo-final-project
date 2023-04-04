<?php

namespace AppSession;
class AppSession
{
    public static function ValidaAppSessionLogin()
    {
        session_start();
        if (!is_null($_SESSION) && $_SESSION['logado']) {
            header('Location: index.php');
        }
    }

    public static function ValidaAppSession($app = false)
    {
        session_start();
        if (is_null($_SESSION) || !$_SESSION['logado']) {
            if ($app) {
                header('Location: ../../login.php?permissao=false');
            } else {
                header('Location: login.php?permissao=false');
            }
        }
    }

    public static function initSession($email)
    {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['logado'] = true;
    }

    public static function getName($queryNome)
    {
        session_start();
        $_SESSION['queryNome'] = $queryNome;
    }
}