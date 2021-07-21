<?php


class auth
{
    const ACCESS_TYPE_WORKER = 'worker';
    const ACCESS_TYPE_STUDENTS = 'student';
    const ACCESS_TYPE_ADMIN = 'admin';

    const LOGIN_PAGE = 'login-page.php';

    const SUCCESS_URL = [
        self::ACCESS_TYPE_WORKER => 'worker.php',
        self::ACCESS_TYPE_STUDENTS => 'student.php'
    ];

    /** @var PDO */
    private $db;
    private $redirectUrl;

    public static function redirect($url)
    {
        header('Location: /' . $url);
    }

    public function __construct(PDO $db)
    {
        $this->db = $db;
        session_start();
    }

    public function login($login, $password)
    {
        $sql = 'SELECT *
                FROM `users`
                WHERE `login` = :login AND `password` = :password AND `active` = 1';
        $query = $this->db->prepare($sql);
        $query->execute(['login' => $login, 'password' => $password]);
        if ($query->rowCount() === 1) {
            $userInfo = $query->fetch(PDO::FETCH_UNIQUE);
            $_SESSION['user']['id'] = $userInfo[0];
            $_SESSION['user']['login'] = $userInfo[1];
            $_SESSION['user']['username'] = implode(' ', [$userInfo[3], $userInfo[4], $userInfo[5]]);
            $_SESSION['user']['access'] = $userInfo[6];
            $this->redirectUrl = self::SUCCESS_URL[$_SESSION['user']['access']];
            self::redirect($this->redirectUrl);
            return true;
        }

        return false;
    }

    public function check()
    {
        $user = $this->getUser();

        return empty($user) ? [] : $user;
    }

    public function logout()
    {
        session_destroy();
        self::redirect(self::LOGIN_PAGE);
    }

    public function getUser()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            $this->redirectUrl = self::SUCCESS_URL[$_SESSION['user']['access']];
            return $_SESSION['user'];
        }

        return [];
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }
}