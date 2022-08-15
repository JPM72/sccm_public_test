
<?php
class Connect extends PDO{
    public function __construct(){
        parent::__construct("mysql:host=localhost;dbname=google_login", 'root', 'Bumpman1',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}

class Controller {

    // Print data to the screen
    function printData($id){

        $db = new Connect;
        $user = $db -> prepare('SELECT * FROM users ORDER BY id');
        $user -> execute();
        $content = '
        <table class="table">
            <tbody>';
        while($userInfo = $user -> fetch(PDO::FETCH_ASSOC)){
            $content .= '
            <tr>
                <td>Logged in as:</td>
                <td>'.$userInfo["f_name"].'</td>
                <td>'.$userInfo["l_name"].'</td>
                <td><img style="max-width: 50px;" src="'.$userInfo["avatar"].'" alt="User Avatar"></td>
                <td>'.$userInfo["email"].'</td>
                <td><a href="php/logout.php">Log Out</a></td>
            </tr>
            ';
        }
        $content .= '</tbody></table>
        ';
        return $content;
    }

    // check if user is logged in
    function checkUserStatus($id, $sess){
        file_put_contents("test.log", "hello", FILE_APPEND);
        $db = new Connect;
        $user = $db -> prepare("SELECT id FROM users WHERE id=:id AND session=:session");
        $user -> execute([
            ':id'       => intval($id),
            ':session'  => $sess
        ]);
        $userInfo = $user -> fetch(PDO::FETCH_ASSOC);
        if(!$userInfo["id"]){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    // function for generating password and login session
    function generateCode($length){
        $chars = "vwxysdfzsdfABChfdsSDD02789";
        $code = ""; 
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length){ 
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

    // insert data
    function insertData($data){
        $db = new Connect;

        // Check if users email already exists on the system.
        $checkUser = $db -> prepare("SELECT * FROM users WHERE email=:email");
        $checkUser -> execute(array(
            'email' => $data['email']
        ));
        $info = $checkUser -> fetch(PDO::FETCH_ASSOC);
        
        // If users email not in table, insert
        if(!$info["id"]){
            $session = $this->generateCode(10);
            $insertNewUser = $db -> prepare("INSERT INTO users (f_name, l_name, avatar, email, password, session) VALUES (:f_name, :l_name, :avatar, :email, :password, :session)");
            $insertNewUser -> execute([
                ':f_name'   => $data["givenName"],
                ':l_name'   => $data["familyName"],
                ':avatar'   => $data["avatar"],
                ':email'    => $data["email"],
                ':password' => $this->generateCode(5),
                ':session'  => $session
            ]);
            if($insertNewUser){
                setcookie("id", $db->lastInsertId(), time()+60*60*24*30, "/", NULL);
                setcookie("sess", $session, time()+60*60*24*30, "/", NULL);
                header('Location: ../index.php');
                exit();
            }else{
                return "Error inserting user!";
            }
        }else{
            setcookie("id", $info['id'], time()+60*60*24*30, "/", NULL);
            setcookie("sess", $info["session"], time()+60*60*24*30, "/", NULL);
            header('Location: ../index.php');
            exit();
        }
    }
}

?>