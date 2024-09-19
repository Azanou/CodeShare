<?php
include('config/database.php');

//sanitizer
if (!function_exists('e')) {

    function e($string)
    {
        if ($string) {
            return htmlspecialchars($string);
        }
    }
}



//create and save that new micropost in the micropost table
if (!function_exists('create_micropost_for_the_current_user')) {

    function create_micropost_for_the_current_user($content)
    {
        global $db;
        $q = $db-> prepare('INSERT INTO microposts(content, user_id) VALUES(:content, :user_id)');
        $q->execute([
            'content'=>$content,
            'user_id'=>get_session('user_id')
        ]);   
    }
}







// check if the user has already liked the given micropost

if (!function_exists('user_has_already_liked')) {
    function user_has_already_liked($micropost_id)
    {
        global $db;
        $q = $db->prepare("SELECT id  FROM  micropost_like WHERE user_id = :user_id AND  micropost_id = :micropost_id");
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);
        $count = $q->rowCount();
        return (bool)$count;
    }
}
//Allow the user to like a micropost
if (!function_exists('like_micropost')) {

    function like_micropost($micropost_id)
    {
        global $db;
        if (!user_has_already_liked($micropost_id)) {

            $q = $db->prepare("INSERT INTO micropost_like(user_id, micropost_id) VALUES (:user_id, :micropost_id)");
            $q->execute([
                'user_id' => get_session('user_id'),
                'micropost_id' => $micropost_id
            ]);

            $q = $db->prepare("UPDATE microposts SET like_count = like_count + 1 WHERE id = :micropost_id");
            $q->execute([
                'micropost_id' => $micropost_id
            ]);
        }
    }
}

//Allow the user to unlike a micropost
if (!function_exists('unlike_micropost')) {

    function unlike_micropost($micropost_id)
    {
        if (user_has_already_liked($micropost_id)) {
            global $db;
            $q = $db->prepare("DELETE FROM  micropost_like WHERE user_id = :user_id AND micropost_id = :micropost_id ");
            $q->execute([
                'user_id' => get_session('user_id'),
                'micropost_id' => $micropost_id
            ]);

            $q = $db->prepare("UPDATE microposts SET like_count = like_count - 1 WHERE id = :micropost_id");
            $q->execute([
                'micropost_id' => $micropost_id
            ]);
        }
    }
}

//Hey there, how many likes does a given micropost have ??
if (!function_exists('get_like_count')) {

    function get_like_count($micropostId)
    {
        global $db;
        $q = $db->prepare("SELECT like_count FROM microposts WHERE id = ? ");
        $q->execute([$micropostId]);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return intval($data['like_count']);
    }
}

//who are those who liked that micropost ??
if (!function_exists('get_likers')) {

    function get_likers($micropostId)
    {
        global $db;
        $q = $db->prepare("SELECT users.id, users.pseudo FROM users LEFT JOIN micropost_like  as ML ON users.id = ML.user_id 
                            WHERE ML.micropost_id = ?
                            LIMIT 3");
        $q->execute([$micropostId]);
        return $q->fetchAll(PDO::FETCH_OBJ);
    }
}


//show you've liked a micropost
if (!function_exists('get_likers_text')) {

    function get_likers_text($micropostId)
    {
        $like_count = get_like_count($micropostId);
        $likers = get_likers($micropostId);
        $remaining_like_count = 0;

        $output = '';

        if ($like_count > 0) {

            $remaining_like_count = $like_count - 3;
            $itself_like = user_has_already_liked($micropostId);

            foreach ($likers as $liker) {
                if (get_session('user_id') != $liker->id) {
                    $output .= "<a href='profile.php?id=" . e($liker->id) . "'>" . e($liker->pseudo) . "</a> ,";
                }
            }
            $output = $itself_like ? "vous, " . $output : $output;
            $output = trim($output, ', ');

            if(($like_count == 2 || $like_count == 3) && !empty($output)){
                $arr = explode(',',$output);
                $lastItem = array_pop($arr);
                $output = implode(', ', $arr);
                $output.= ' et '.$lastItem;
            }
            switch($like_count){
                case 1:
                    $output .= $itself_like ? " aimez cela " : " aime cela";
                break;

                case 2:
                case 3:
                    $output .= $itself_like? " aimez cela" :" aiment cela";
                break;

                case 4:
                    $output .= $itself_like? " et 1 autre aimez cela" : " et 1 autre aiment cela";
                break;

                default:
                    $output .= $itself_like? " et ".$remaining_like_count." autres aimez cela" : " et ".$remaining_like_count." aiment cela";
                break;
            }
        }
        return $output;
    }
}

//check if a friend request has already been sent 
if (!function_exists('if_a_friend_request_has_already_been_sent')) {

    function if_a_friend_request_has_already_been_sent($id1, $id2)
    {
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships WHERE 
                            (user_id1 = :user_id1 AND user_id2 = :user_id2)
                            OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
        $q->execute([
            'user_id1' => $id1,
            'user_id2' => $id2
        ]);
        $count = $q->rowCount();
        $q->closeCursor();
        return (bool)$count;
    }
}


//check if the current user is friend with the second user(the one he's on the profile)
if (!function_exists('current_user_is_friend_with')) {

    function current_user_is_friend_with($second_user_id)
    {
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships WHERE 
                             ((user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1))
                            AND status ='1' OR status = '2' ");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $second_user_id
        ]);
        $count = $q->rowCount();
        $q->closeCursor();
        return (bool)$count;
    }
}

//friends count
if (!function_exists('friends_count')) {

    function friends_count($id)
    {
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships
                            WHERE (user_id1 = :user OR user_id2 = :user)
                            AND status = '1' ");
        $q->execute([
            'user' => $id
        ]);
        $count = $q->rowCount();
        $q->closeCursor();
        return $count;
    }
}

if (!function_exists('relation_link_to_display')) {

    function relation_link_to_display($id)
    {
        global $db;
        $q = $db->prepare("SELECT user_id1,user_id2, status FROM friends_relationships WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $id
        ]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        if ($data->user_id1 == $id && $data->status == '0') {
            //links to Confirm or refute the demand
            return "accept_reject_relation_link";
        } elseif ($data->user_id1 == get_session('user_id') && $data->status == '0') {
            //links to cancel the request to connect
            return "cancel_relation_link";
        } elseif ($data->status == '1') {
            // links to delete the connection
            return "delete_relation_link";
        } else {
            //link to add the user as a friend
            return "add_relation_link";
        }
    }
}


// Here is cell_count() , that return the number of lines 
// which respect a certain condition in our Db!!
if (!function_exists('cell_count')) {

    function cell_count($table, $field_name, $field_value)
    {
        global $db;
        $q = $db->prepare("SELECT * FROM $table WHERE $field_name = ?");
        $q->execute([$field_value]);

        return $q->rowCount();
    }
}

//remember me !!!

if (!function_exists('remember_me')) {

    function remember_me($user_id)
    {
        global $db;
        // Generate the token randomly
        $token = openssl_random_pseudo_bytes(24);
        // generate the selector randomly, and assure that it's unique
        do {
            $selector = bin2hex(openssl_random_pseudo_bytes(9));
        } while (cell_count('auth_tokens', 'selector', $selector) > 0);




        // save these infos : (user_id, selector, expires(after 14 days), token(a hasked version)) in the database
        try {
            $q = $db->prepare("INSERT INTO auth_tokens(expires, user_id, token, selector) VALUES ( DATE_ADD(NOW(), INTERVAL 14 DAY),:user_id, :token ,:selector)");
            $q->execute([
                'user_id' => $user_id,
                'token' => hash('sha256', $token),
                'selector' => $selector
            ]);
        } catch (PDOException $e) {
            echo "error: " . $e;
        }
        //create a cookie , let's call it "auth" (14 days to expires) in httpOnly 
        setcookie(
            'auth',
            base64_encode($selector) . ':' . base64_encode($token),
            null,
            time() + 3600 * 24 * 14,
            false,
            true
        );
        //content of our coookie: base64_encode(selector).':'.base64_encode(token)
    }
}


//auto login

if (!function_exists('auto_login')) {

    function auto_login()
    {
        global $db;
        //check if our cookie 'auth' exists
        if (!empty($_COOKIE['auth'])) {
            $split = explode(':', $_COOKIE['auth']);

            if (count($split) != 2) {
                return false;
            }
            //recover $selector and $token via our array split 
            list($selector, $token) = $split;

            //use the $token and $selector recovered to retrieve some informations about the user in the db
            $q = $db->prepare('SELECT auth_tokens.token, auth_tokens.user_id, users.id, 
                                      users.pseudo, users.avatar, users.email 
                                      FROM auth_tokens  LEFT JOIN users ON auth_tokens.user_id = users.id 
                                      WHERE selector = ? AND expires >= CURDATE()');
            $q->execute([base64_decode($selector)]);

            $data = $q->fetch(PDO::FETCH_OBJ);

            if ($data) {
                if (hash_equals($data->token, hash('sha256', base64_decode($token))));
                session_regenerate_id(true);
                $_SESSION['user_id'] = $data->id;
                $_SESSION['pseudo'] = $data->pseudo;
                $_SESSION['avatar'] = $data->avatar;
                $_SESSION['email'] = $data->email;
                return true;
            }
        }
        return false;
    }
}

//Intentional redirection of the user
if (!function_exists('redirect_intent_or')) {

    function redirect_intent_or($default_url)
    {
        if ($_SESSION['forwarding_url']) {
            $url = $_SESSION['forwarding_url'];
        } else {
            $url = $default_url;
        }
        $_SESSION['forwarding_url'] = null;
        redirect($url);
    }
}

// get a session value by key
if (!function_exists('get_session')) {

    function get_session($key)
    {
        return !empty($_SESSION[$key]) ? e($_SESSION[$key]) : null;
    }
}

// get a session value of the current language in use
if (!function_exists('get_current_locale')) {

    function get_current_locale()
    {
        return $_SESSION['locale'];
    }
}

// check is an user is connected(it mean that he/has already validate registraction and logged in)
if (!function_exists('is_logged_in')) {

    function is_logged_in()
    {
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
    }
}

// getthe avatar of the user
if (!function_exists('get_avatar_url')) {

    function get_avatar_url($email, $seize = 25)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim(e($email)))) . "?s=" . $seize . "&d=wavatar";
    }
}

//make our micropost able de highlights links
if (!function_exists('replace_links')) {

    function replace_links($texte)
    {
        return preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="">@$2</a>', '$1<a href="index.php?hashtag=$2">#$2</a>'), $texte);
    }
}


//Find user by id
if (!function_exists('find_user_by_id')) {

    function find_user_by_id($id)
    {
        global $db;
        $q = $db->prepare("SELECT name,pseudo,email,city,country,twitter,github,sex,bio,available_for_hiring,avatar FROM users WHERE id=?");
        $q->execute([$id]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        return $data;
    }
}

//Find code by id
if (!function_exists('find_code_by_id')) {

    function find_code_by_id($id)
    {
        global $db;
        $q = $db->prepare('SELECT code FROM codes WHERE id=?');
        $q->execute([$id]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        return $data;
    }
}



if (!function_exists('not_empty')) {

    function not_empty($fields = [])
    {
        if (count($fields) != 0) {
            foreach ($fields as $field) {
                if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
                    return false;
                }
            }
            return true;
        }
    }
}

if (!function_exists('is_already_in_use')) {
    function is_already_in_use($field, $value, $table)
    {
        global $db;
        $q = $db->prepare("SELECT id FROM $table WHERE $field = ?");
        $q->execute([$value]);
        $count = $q->rowCount();
        $q->closeCursor();
        return $count;
    }
}

//informer l'utilisateur pour qu'il verifie sa boite de reception
if (!function_exists('set_flash')) {
    function set_flash($message, $type = "info")
    {
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;
    }
}

// retourne a la page specifie

if (!function_exists('redirect')) {
    function redirect($page)
    {
        header('Location:' . $page);
        exit();
    }
}

// sauvegarde les inputs specifier en session

if (!function_exists('save_input_data')) {
    function save_input_data()
    {
        global $db;
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'password') === false) {
                $_SESSION['input'][$key] = $value;
            }
        }
    }
}

// recupere les input du formulaire stockes de maniere temporaire en session

if (!function_exists('get_input')) {
    function get_input($key)
    {
        return !empty($_SESSION['input'][$key]) ? e($_SESSION['input'][$key]) : null;
    }
}

//supprime tous les formulaires stockes de maniere temporaire en session

if (!function_exists('clear_input_data')) {
    function clear_input_data()
    {
        if (isset($_SESSION['input'])) {
            $_SESSION['input'] = [];
        }
    }
}

//gere l'etat actif de nos differents onglets
if (!function_exists('set_active')) {
    function set_active($file, $color = 'background:#252c3a; border-radius:30px;')
    {
        $page = array_pop(explode('/', $_SERVER['SCRIPT_NAME']));

        if ($page == $file . ".php") {
            return $color;
        } else {
            return '';
        }
    }
}
