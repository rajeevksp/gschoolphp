<?php
 
include("database.php");
 
include("form.php");
date_default_timezone_set('Asia/Kolkata');
class Session
{
   var $username;     //Username given on sign-up
   var $userid;       //Random value generated on current login
   var $userlevel;    //The level to which the user pertains
   var $time;         //Time user was last active (page loaded)
   var $logged_in;    //True if user is logged in, false otherwise
   var $userinfo = array();  //The array holding all user info
   var $url;          //The page url current being viewed
   var $referrer;     //Last recorded site page viewedf
   /**
    * Note: referrer should really only be considered the actual
    * page referrer in process.php, any other time it may be
    * inaccurate.
    */

   /* Class constructor */
   function Session(){
      $this->time = time();
      $this->startSession();
   }

   /**
    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   function startSession(){
      global $database;  //The database connection
      session_start();   //Tell PHP to start the session

      /* Determine if user is logged in */
      $this->logged_in = $this->checkLogin();

      /**
       * Set guest value to users not logged in, and update
       * active guests table accordingly.
       */
      if(!$this->logged_in){
         $this->username = $_SESSION['username'] = GUEST_NAME;
         $this->userlevel = GUEST_LEVEL;
         $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      }
      /* Update users last active timestamp */
      else{
         $database->addActiveUser($this->username, $this->time);
      }
      
      /* Remove inactive visitors from database */
      $database->removeInactiveUsers();
      $database->removeInactiveGuests();
      
      /* Set referrer page */
      if(isset($_SESSION['url'])){
         $this->referrer = $_SESSION['url'];
      }else{
         $this->referrer = "/";
      }

      /* Set current url */
      $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
   }

   /**
    * checkLogin - Checks if the user has already previously
    * logged in, and a session with the user has already been
    * established. Also checks to see if user has been remembered.
    * If so, the database is queried to make sure of the user's 
    * authenticity. Returns true if the user has logged in.
    */
   function checkLogin(){
      global $database;  //The database connection
      /* Check if user has been remembered */
      if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookid'])){
         $this->username = $_SESSION['username'] = $_COOKIE['cookname'];
         $this->userid   = $_SESSION['userid']   = $_COOKIE['cookid'];
      }

      /* Username and userid have been set and not guest */
      if(isset($_SESSION['username']) && isset($_SESSION['userid']) &&
         $_SESSION['username'] != GUEST_NAME){
         /* Confirm that username and userid are valid */
         if($database->confirmUserID($_SESSION['username'], $_SESSION['userid']) != 0){
            /* Variables are incorrect, user not logged in */
            unset($_SESSION['username']);
            unset($_SESSION['userid']);
            return false;
         }

         /* User is logged in, set class variables */
         $this->userinfo  = $database->getUserInfo($_SESSION['username']);
         $this->username  = $this->userinfo['username'];
         $this->userid    = $this->userinfo['userid'];
         $this->userlevel = $this->userinfo['userlevel'];
         
         /* auto login hash expires in three days */
         if($this->userinfo['hash_generated'] < (time() - (60*60*24*3))){
         	/* Update the hash */
	         $database->updateUserField($this->userinfo['username'], 'hash', $this->generateRandID());
	         $database->updateUserField($this->userinfo['username'], 'hash_generated', time());
         }
         
         return true;
      }
      /* User not logged in */
      else{
         return false;
      }
   }

   /**
    * login - The user has submitted his username and password
    * through the login form, this function checks the authenticity
    * of that information in the database and creates the session.
    * Effectively logging in the user if all goes well.
    */
   function login($subuser, $subpass, $subremember){
      global $database, $form;  //The database and form object

      /* Username error checking */
      $field = "user";  //Use field name for username
	  $q = "SELECT valid FROM ".TBL_USERS." WHERE username='$subuser'";
	  $valid = $database->query($q);
	  $valid = mysqli_fetch_array($valid);
	  	      
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered");
      }
      else{
         /* Check if username is not alphanumeric */
         if(!ctype_alnum($subuser)){
            $form->setError($field, "* Username not alphanumeric");
         }
      }	  

      /* Password error checking */
      $field = "pass";  //Use field name for password
      if(!$subpass){
         $form->setError($field, "* Password not entered");
      }
      
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }

      /* Checks that username is in database and password is correct */
      $subuser = stripslashes($subuser);
      $result = $database->confirmUserPass($subuser, $subpass);

      /* Check error codes */
      if($result == 1){
         $field = "user";
         $form->setError($field, "* Username not found");
      }
      else if($result == 2){
         $field = "pass";
         $form->setError($field, "* Invalid password");
      }
      
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }

      
      if(EMAIL_WELCOME){
      	if($valid['valid'] == 0){
      		$form->setError($field, "* User's account has not yet been confirmed.");
      	}
      }
                  
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }
      


      /* Username and password correct, register session variables */
      $this->userinfo  = $database->getUserInfo($subuser);
      $this->username  = $_SESSION['username'] = $this->userinfo['username'];
      $this->userid    = $_SESSION['userid']   = $this->generateRandID();
      $this->userlevel = $this->userinfo['userlevel'];
      
      /* Insert userid into database and update active users table */
      $database->updateUserField($this->username, "userid", $this->userid);
      $database->addActiveUser($this->username, $this->time);
      $database->removeActiveGuest($_SERVER['REMOTE_ADDR']);

      /**
       * This is the cool part: the user has requested that we remember that
       * he's logged in, so we set two cookies. One to hold his username,
       * and one to hold his random value userid. It expires by the time
       * specified in constants.php. Now, next time he comes to our site, we will
       * log him in automatically, but only if he didn't log out before he left.
       */
      if($subremember){
         setcookie("cookname", $this->username, time()+COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   $this->userid,   time()+COOKIE_EXPIRE, COOKIE_PATH);
      }

      /* Login completed successfully */
      return true;
   }

   /**
    * logout - Gets called when the user wants to be logged out of the
    * website. It deletes any cookies that were stored on the users
    * computer as a result of him wanting to be remembered, and also
    * unsets session variables and demotes his user level to guest.
    */
   function logout(){
      global $database;  //The database connection
      /**
       * Delete cookies - the time must be in the past,
       * so just negate what you added when creating the
       * cookie.
       */
      if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookid'])){
         setcookie("cookname", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   "", time()-COOKIE_EXPIRE, COOKIE_PATH);
      }

      /* Unset PHP session variables */
      unset($_SESSION['username']);
      unset($_SESSION['userid']);

      /* Reflect fact that user has logged out */
      $this->logged_in = false;
      
      /**
       * Remove from active users table and add to
       * active guests tables.
       */
      $database->removeActiveUser($this->username);
      $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      
      /* Set user level to guest */
      $this->username  = GUEST_NAME;
      $this->userlevel = GUEST_LEVEL;
   }

   /**
    * register - Gets called when the user has just submitted the
    * registration form. Determines if there were any errors with
    * the entry fields, if so, it records the errors and returns
    * 1. If no errors were found, it registers the new user and
    * returns 0. Returns 2 if registration failed.
    */
   function register($subuser, $subpass, $subemail, $subname){
   
      global $database, $form, $mailer;  //The database, form and mailer object
      
      /* Username error checking */
      $field = "user";  //Use field name for username
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered");
      }
      else{
         /* Spruce up username, check length */
         $subuser = stripslashes($subuser);
         if(strlen($subuser) < 5){
            $form->setError($field, "* Username below 5 characters");
         }
         else if(strlen($subuser) > 30){
            $form->setError($field, "* Username above 30 characters");
         }
         /* Check if username is not alphanumeric */
         else if(!ctype_alnum($subuser)){
            $form->setError($field, "* Username not alphanumeric");
         }
         /* Check if username is reserved */
         else if(strcasecmp($subuser, GUEST_NAME) == 0){
            $form->setError($field, "* Username reserved word");
         }
         /* Check if username is already in use */
         else if($database->usernameTaken($subuser)){
            $form->setError($field, "* Username already in use");
         }
         /* Check if username is banned */
         else if($database->usernameBanned($subuser)){
            $form->setError($field, "* Username banned");
         }
      }

      /* Password error checking */
      $field = "pass";  //Use field name for password
      if(!$subpass){
         $form->setError($field, "* Password not entered");
      }
      else{
         /* Spruce up password and check length*/
         $subpass = stripslashes($subpass);
         if(strlen($subpass) < 4){
            $form->setError($field, "* Password too short");
         }
         /* Check if password is not alphanumeric */
         else if(!ctype_alnum(($subpass = trim($subpass)))){
            $form->setError($field, "* Password not alphanumeric");
         }
         /**
          * Note: I trimmed the password only after I checked the length
          * because if you fill the password field up with spaces
          * it looks like a lot more characters than 4, so it looks
          * kind of stupid to report "password too short".
          */
      }
      
      /* Email error checking */
      $field = "email";  //Use field name for email
      if(!$subemail || strlen($subemail = trim($subemail)) == 0){
         $form->setError($field, "* Email not entered");
      }
      else{
         /* Check if valid email address */
         if(filter_var($subemail, FILTER_VALIDATE_EMAIL) == FALSE){
            $form->setError($field, "* Email invalid");
         }
         /* Check if email is already in use */
         if($database->emailTaken($subemail)){
            $form->setError($field, "* Email already in use");
         }

         $subemail = stripslashes($subemail);
      }
      
      /* Name error checking */
	  $field = "name";
	  if(!$subname || strlen($subname = trim($subname)) == 0){
	     $form->setError($field, "* Name not entered");
	  } else {
	     $subname = stripslashes($subname);
	  }
      
      $randid = $this->generateRandID();
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return 1;  //Errors with form
      }
      /* No errors, add the new account to the */
      else{
         if($database->addNewUser($subuser, md5($subpass), $subemail, $randid, $subname)){
            if(EMAIL_WELCOME){               
               $mailer->sendWelcome($subuser,$subemail,$subpass,$randid);
            }
            return 0;  //New user added succesfully
         }else{
            return 2;  //Registration attempt failed
         }
      }
   }
   
   /**
    * editAccount - Attempts to edit the user's account information
    * including the password, which it first makes sure is correct
    * if entered, if so and the new password is in the right
    * format, the change is made. All other fields are changed
    * automatically.
    */
   function editAccount($subcurpass, $subnewpass, $subemail, $subname){
      global $database, $form;  //The database and form object
      /* New password entered */
      if($subnewpass){
         /* Current Password error checking */
         $field = "curpass";  //Use field name for current password
         if(!$subcurpass){
            $form->setError($field, "* Current Password not entered");
         }
         else{
            /* Check if password too short or is not alphanumeric */
            $subcurpass = stripslashes($subcurpass);
            if(strlen($subcurpass) < 4 ||
               !preg_match("^([0-9a-z])+$", ($subcurpass = trim($subcurpass)))){
               $form->setError($field, "* Current Password incorrect");
            }
            /* Password entered is incorrect */
            if($database->confirmUserPass($this->username,md5($subcurpass)) != 0){
               $form->setError($field, "* Current Password incorrect");
            }
         }
         
         /* New Password error checking */
         $field = "newpass";  //Use field name for new password
         /* Spruce up password and check length*/
         $subpass = stripslashes($subnewpass);
         if(strlen($subnewpass) < 4){
            $form->setError($field, "* New Password too short");
         }
         /* Check if password is not alphanumeric */
         else if(!preg_match("^([0-9a-z])+$", ($subnewpass = trim($subnewpass)))){
            $form->setError($field, "* New Password not alphanumeric");
         }
      }
      /* Change password attempted */
      else if($subcurpass){
         /* New Password error reporting */
         $field = "newpass";  //Use field name for new password
         $form->setError($field, "* New Password not entered");
      }
      
      /* Email error checking */
      $field = "email";  //Use field name for email
      if($subemail && strlen($subemail = trim($subemail)) > 0){
         /* Check if valid email address */
         if(filter_var($subemail, FILTER_VALIDATE_EMAIL) == FALSE){
            $form->setError($field, "* Email invalid");
         }
         $subemail = stripslashes($subemail);
      }
      
      /* Name error checking */
	  $field = "name";
	  if(!$subname || strlen($subname = trim($subname)) == 0){
	     $form->setError($field, "* Name not entered");
	  } else {
	     $subname = stripslashes($subname);
	  }
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return false;  //Errors with form
      }
      
      /* Update password since there were no errors */
      if($subcurpass && $subnewpass){
         $database->updateUserField($this->username,"password",md5($subnewpass));
      }
      
      /* Change Email */
      if($subemail){
         $database->updateUserField($this->username,"email",$subemail);
      }
      
      /* Change Name */
      if($subname){
         $database->updateUserField($this->username,"name",$subname);
      }
      
      /* Success! */
      return true;
   }
   
   /**
    * isAdmin - Returns true if currently logged in user is
    * an administrator, false otherwise.
    */
   function isAdmin(){
      return ($this->userlevel == ADMIN_LEVEL ||
              $this->username  == ADMIN_NAME);
   }
   
  
   
   /**
    * generateRandID - Generates a string made up of randomized
    * letters (lower and upper case) and digits and returns
    * the md5 hash of it to be used as a userid.
    */
   function generateRandID(){
      return md5($this->generateRandStr(16));
   }
   
   /**
    * generateRandStr - Generates a string made up of randomized
    * letters (lower and upper case) and digits, the length
    * is a specified parameter.
    */
   function generateRandStr($length){
      $randstr = "";
      for($i=0; $i<$length; $i++){
         $randnum = mt_rand(0,61);
         if($randnum < 10){
            $randstr .= chr($randnum+48);
         }else if($randnum < 36){
            $randstr .= chr($randnum+55);
         }else{
            $randstr .= chr($randnum+61);
         }
      }
      return $randstr;
   }
   
   function cleanInput($post = array()) {
       foreach($post as $k => $v){
            $post[$k] = strtolower(trim(htmlspecialchars($v)));
			
         }
         return $post;
   }
   
/*Pagination code*/
	 function showPagination($pagename,$tbl_name,$start,$limit,$page,$condition){
		 
		$database = new MySQLDB;
        //your table name
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
   

   
   
    /*
       First get total number of rows in data table.
       If you have a WHERE clause in your query, make sure you mirror it here.
    */
    $query = "SELECT COUNT(*) as num FROM $tbl_name $condition ";
    $total_pages = mysqli_fetch_array($database->query($query));
    $total_pages = $total_pages['num'];
   

   
    /* Setup vars for query. */
    $targetpage = $pagename;     //your file name  (the name of this file)
                                //how many items to show per page
   


   
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
    $prev = $page - 1;                            //previous page is page - 1
    $next = $page + 1;                            //next page is page + 1
    $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                        //last page minus 1
   
    /*
        Now we apply our rules and draw the pagination object.
        We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    {   
        $pagination .= "<div class=\"pagination\">";
        //previous button
        if ($page > 1){
         
		    $pagination.= "<a onclick=\"setStateGet('adminTable','".$targetpage."','page=".$prev."')\">&laquo; previous</a>";
		}
        else{
            $pagination.= "<span class=\"disabled\">&laquo; previous</span>";   
		}
        //pages   
        if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a  onclick=\"setStateGet('adminTable','".$targetpage."','page=".$counter."')\">$counter</a>";                   
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))       
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a   onclick=\"setStateGet('adminTable','".$targetpage."','page=".$counter."')\">$counter</a>";                   
                }
                $pagination.= "...";
                $pagination.= "<a onclick=\"setStateGet('adminTable','".$targetpage."','page=".$lpm1."')\">$lpm1</a>";
                $pagination.= "<a  onclick=\"setStateGet('adminTable','".$targetpage."','page=".$lastpage."')\">$lastpage</a>";       
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a  onclick=\"setStateGet('adminTable','".$targetpage."','page=1')\">1</a>";
                $pagination.= "<a onclick=\"setStateGet('adminTable','".$targetpage."','page=2')\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a onclick=\"setStateGet('adminTable','".$targetpage."','page=".$counter."')\">$counter</a>";                   
                }
                $pagination.= "...";
                $pagination.= "<a >$lpm1</a>";
                $pagination.= "<a onclick=\"setStateGet('adminTable','".$targetpage."','page=".$lastpage."')\">$lastpage</a>";       
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<a onclick=\"setStateGet('adminTable','".$targetpage."','page=1')\">1</a>";
                $pagination.= "<a  onclick=\"setStateGet('adminTable','".$targetpage."','page=2')\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a  onclick=\"setStateGet('adminTable','".$targetpage."','page=".$counter."')\">$counter</a>";                   
                }
            }
        }
       
        //next button
        if ($page < $counter - 1)
            $pagination.= "<a  onclick=\"setStateGet('adminTable','".$targetpage."','page=".$next."')\">next &raquo;</a>";
        else
            $pagination.= "<span class=\"disabled\">next  &raquo;</span>";
        $pagination.= "</div>\n";       
    }   
   
   
    return $pagination;
   

}

 


function resize($source_image, $destination, $tn_w, $tn_h, $quality = 100, $wmsource = false)
{
    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);

    #assuming the mime type is correct
    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
            die('Invalid image type.');
    }

    #Figure out the dimensions of the image and the dimensions of the desired thumbnail
    $src_w = imagesx($source);
    $src_h = imagesy($source);


    #Do some math to figure out which way we'll need to crop the image
    #to get it proportional to the new size, then crop or adjust as needed

    $x_ratio = $tn_w / $src_w;
    $y_ratio = $tn_h / $src_h;

    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
        $new_w = $src_w;
        $new_h = $src_h;
    } elseif (($x_ratio * $src_h) < $tn_h) {
        $new_h = ceil($x_ratio * $src_h);
        $new_w = $tn_w;
    } else {
        $new_w = ceil($y_ratio * $src_w);
        $new_h = $tn_h;
    }

    $newpic = imagecreatetruecolor(round($new_w), round($new_h));
    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
    $final = imagecreatetruecolor($tn_w, $tn_h);
    $backgroundColor = imagecolorallocate($final, 255, 255, 255);
    imagefill($final, 0, 0, $backgroundColor);
    //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
    imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);

    #if we need to add a watermark
    if ($wmsource) {
        #find out what type of image the watermark is
        $info    = getimagesize($wmsource);
        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $watermark = imagecreatefromjpeg($wmsource);
                break;
            case 'image/gif':
                $watermark = imagecreatefromgif($wmsource);
                break;
            case 'image/png':
                $watermark = imagecreatefrompng($wmsource);
                break;
            default:
                die('Invalid watermark type.');
        }

        #if we're adding a watermark, figure out the size of the watermark
        #and then place the watermark image on the bottom right of the image
        $wm_w = imagesx($watermark);
        $wm_h = imagesy($watermark);
        imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);

    }
    if (imagejpeg($final, $destination, $quality)) {
        return true;
    }
    return false;
}

  

  /*imageResize - Resizes images of all types to the specified dimentions.
  Preserves image alpha channel information also*/
  
  function image_resize($src, $dst, $width, $height, $crop=0){

  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

  $type = strtolower(substr(strrchr($src,"."),1));
  if($type == 'jpeg') $type = 'jpg';
  switch($type){
    case 'bmp': $img = imagecreatefromwbmp($src); break;
    case 'gif': $img = imagecreatefromgif($src); break;
    case 'jpg': $img = imagecreatefromjpeg($src); break;
    case 'png': $img = imagecreatefrompng($src); break;
    default : return "Unsupported picture type!";
  }

  // resize
  if(is_array($crop)){
	 // $_SESSION['crop'] = 'Is here.. reading crop array';
	   $ratio = max($width/$w, $height/$h);
	   
   if($w < $width or $h < $height){
	//$_SESSION['crop'].= "Picture is too small!".$ratio;
      
   }
   
    $h = $crop['height'];
    $x = $crop['x'];
    $w = $crop['width'];
	$y= $crop['y'];
	
  }
  else{
    if($w < $width and $h < $height) return "Picture is too small!";
    $ratio = min($width/$w, $height/$h);
    $width = $w * $ratio;
    $height = $h * $ratio;
    $x = 0;
	$y=0;
  }

  $new = imagecreatetruecolor($width, $height);

  // preserve transparency
  if($type == "gif" or $type == "png"){
    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
    imagealphablending($new, false);
    imagesavealpha($new, true);
  }

// $_SESSION['crop'].= "x:".$x."--y:".$y."--W:".$w."--H:".$h."--Width:".$width."--Height:".$height;
  imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $w, $h);

  switch($type){
    case 'bmp': imagewbmp($new, $dst); break;
    case 'gif': imagegif($new, $dst); break;
    case 'jpg': imagejpeg($new, $dst); break;
    case 'png': imagepng($new, $dst); break;
  }
  return true;
}


 //Functions for all Includes 
 
 function commonJS(){
   ?>
   <script src="<?php echo JS_PATH;?>jquery-1.11.1-min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
<script>
	$(window).load(function() {
		$(".preloader").fadeOut("fast");
	});
</script> 
<script src="<?php echo JS_PATH;?>bootstrap.min.js"></script> 
<script src="<?php echo JS_PATH;?>less-2.5.1-min.js"></script> 
<script src="<?php echo JS_PATH;?>bootstrap-select.min.js"></script>
<script src="<?php echo JS_PATH;?>ajaxfunction.js"></script>

<!-- Widget - Animated Progress Bar Scripts --> 
<script src="<?php echo JS_PATH;?>waypoints.min.js"></script> 
<script src="<?php echo JS_PATH;?>waypoint.plugin.js"></script> 
<!-- Animation Effects Scripts--> 
<script src="<?php echo JS_PATH;?>jquery.appear.js"></script> 

<!--magnific popup Script--> 
<script src="<?php echo JS_PATH;?>jquery.magnific-popup.min.js"></script> 
<!--owl carousel Script--> 
<script src="<?php echo JS_PATH;?>owl.carousel.min.js"></script> 
<script src="<?php echo JS_PATH;?>jquery.panorama_viewer.min.js"></script> 

<script src="<?php echo JS_PATH;?>jquery.jplayer.min.js"></script> 
<!--Numbersup Script--> <script src="<?php echo JS_PATH;?>jquery.counterup.min.js"></script> 
<script src="<?php echo JS_PATH;?>autoSuggestv14/jquery.autoSuggest.js"></script> 
 <script src="<?php echo JS_PATH;?>bootstrap-slider.min.js"></script>
<script src="<?php echo CSS_PATH;?>material/js/material.min.js"></script> 
<script src="<?php echo CSS_PATH;?>material/js/ripples.min.js"></script> 
<script src="<?php echo JS_PATH;?>animate.js"></script>  

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wzIkFk79DCKaqn5-sjNgjsngtHQSeRM&signed_in=true"
    ></script>

    <?php
 }
 
  
 
 function commonCSS(){
?>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Pre Loader -->
<link href="<?php echo CSS_PATH;?>pre_loader.css" rel="stylesheet" />
<!-- Font font-awesome -->
<link rel="stylesheet" href="<?php echo CSS_PATH;?>font-awesome.min.css" />
<!-- Google Font Ubuntu -->
<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet" type="text/css" />
<!-- Google Font Raleway -->
<link href="http://fonts.googleapis.com/css?family=Raleway:200,300,600" rel="stylesheet" type="text/css" />
<!-- bootstrap styles -->
<link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
<!-- waypoints styles for skills animation -->
<link href="<?php echo CSS_PATH;?>waypoints.css" rel="stylesheet" />
<!-- animate styles for animation effects -->
<link href="<?php echo CSS_PATH;?>animate.css" rel="stylesheet" />
<!-- back_to_top link styles -->
<link href="<?php echo CSS_PATH;?>back_to_top.css" rel="stylesheet" />
<!-- Style Switcher styles -->
<link href="<?php echo CSS_PATH;?>bootstrap-select.min.css" rel="stylesheet" />
<!-- gallery styles -->
<link href="<?php echo CSS_PATH;?>gallery.css" rel="stylesheet" />
<!-- magnific-popup styles -->
<link href="<?php echo CSS_PATH;?>magnific-popup.css" rel="stylesheet" />
<!-- Owl Carousel Style Assets -->
<link href="<?php echo CSS_PATH;?>owl.carousel.css" rel="stylesheet" />
<link href="<?php echo CSS_PATH;?>owl.theme.css" rel="stylesheet" />
<link href="<?php echo CSS_PATH;?>owl.transitions.css" rel="stylesheet" />
<link href="<?php echo CSS_PATH;?>panorama_viewer.css" rel="stylesheet" />
<link href="<?php echo JS_PATH;?>jplayer.blue.monday.css" rel="stylesheet" />

<link  href="<?php echo CSS_PATH;?>material/css/material.min.css" rel="stylesheet" />
<link  href="<?php echo CSS_PATH;?>material/css/ripples.min.css" rel="stylesheet" />
<!-- Main styles -->
<link href="<?php echo CSS_PATH;?>style.css" rel="stylesheet" />
<!-- Theme Less styles -->
<link href="<?php echo CSS_PATH;?>theme_style.less" rel="stylesheet/less" />
 <link href="<?php echo CSS_PATH;?>bootstrap-slider.min.css" rel="stylesheet" /> 
<link href="<?php echo JS_PATH;?>autoSuggestv14/autoSuggest.css" rel="stylesheet" /> 
<link href="<?php echo CSS_PATH;?>custom.css" rel="stylesheet"  />
<?php
}
 
 
 
function commonFooter(){
	?>
       <!--contact-->
   <section id="footer_1" class="contact big_block">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <div class="contact_info appear-animation" data-appear-animation="fadeInUpDownSmall">
                  <h3 class="style_2">Contact <strong>Info</strong></h3>
                  <ul>
                     <li><i class="fa fa-phone"></i>Phone: (+91) 800-812-3707</li>
                     <li><i class="fa fa-map-marker"></i> Attapur, Hyderabad </li>
                     <li><i class="fa fa-envelope"></i><a href="javascript:void(0);">prakash.deadlock@gmail.com</a></li>
                  </ul>
                  <p>Feel free to contact us or drop in a mail for all your queries.</p>
               </div>
            </div>
            <div class="col-md-6">
               <form   class="row" id="contactform">
                  <div class="col-md-6 col-sm-12">
                     <div class="form-group appear-animation delay_1" data-appear-animation="fadeInUpDownSmall">
                        
                        <input type="text" placeholder="Enter Name" name="name" id="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>" class="form-control floating-label" />
                                         
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                     <div class="form-group appear-animation delay_2" data-appear-animation="fadeInUpDownSmall">
                        
                        <input type="email" name="email" id="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>" placeholder="Enter Email" class="form-control floating-label" />
                                                                 
                     </div>
                  </div>
                  <div class="col-xs-12 appear-animation delay_3" data-appear-animation="fadeInUpDownSmall" />
                     <div class="form-group">
                        
                        <textarea placeholder="Type here message" id="message" name="message" rows="8" class="form-control floating-label"><?php if(isset($_POST['message'])){ echo $_POST['message'];}?></textarea>
                                                                 

                     </div>
                 
                  <div class="col-xs-12 appear-animation delay_4" data-appear-animation="fadeInUpDownSmall">
                     <div class="form-group">
                     <a  class="btn btn-info btn-raised" onClick="setState('adminForm','<?php echo SECURE_PATH;?>ajax.php','validateForm=1&name='+$('#name').val()+'&email='+$('#email').val()+'&message='+$('#message').val()+'<?php if(isset($_POST['editform'])){ echo '&editform='.$_POST['editform'];}?>')">Save</a>
            
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   
   <div id="adminForm"></div>
   <!--map-->
   
   <!--footer-->
   <footer id="anchor_footer_1" class="big_block">
      <div class="container">
         <div class="text-center">
            <h3 class="style_2"><strong>GOOL SCHOOL</strong> - MAKES YOUR SCHOOL SEARCH EASY</h3>
            <!--social icons-->
            <div class="social_icons"><a href="https://facebook.com/goolschool"><i class="fa fa-facebook appear-animation" data-appear-animation="fadeInUpDownSmall"></i></a><a href="https://twitter.com/goolschool"><i class="fa fa-twitter appear-animation delay_2" data-appear-animation="fadeInUpDownSmall"></i></a><a href="https://linkedin.com/goolschool"><i class="fa fa-linkedin appear-animation delay_1" data-appear-animation="fadeInUpDownSmall"></i></a><a class="" href="https://google.com/plus/+goolschool"><i class="fa fa-google-plus appear-animation delay_3" data-appear-animation="fadeInUpDownSmall"></i></a> </div>
            <hr />
            <ul class="foot_nav style_2">
               <li><a href="<?php echo SECURE_PATH;?>">Home</a></li>
               <li><a href="<?php echo SECURE_PATH;?>static/about/">About</a></li>
                <li><a href="<?php echo SECURE_PATH;?>static/blog/">Blog</a></li>
               <li><a href="<?php echo SECURE_PATH;?>static/contact/">Contact</a></li>
            </ul>
            <ul class="foot_nav style_2">
               <li><a href="<?php echo SECURE_PATH;?>static/company/">Company</a></li>
               <li><a href="<?php echo SECURE_PATH;?>static/what_we_do/">What We Do</a></li>
               <li><a href="<?php echo SECURE_PATH;?>static/help/">Help Center</a></li>
               <li><a href="<?php echo SECURE_PATH;?>static/terms/">Terms &amp; Services</a></li>
            </ul>
                <hr />
            <!--Copyright-->
            <p>Copyright &#169; 2015 GoolSchool. All Rights Reserved</p>
         </div>
      </div>
   </footer>
   
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Errors Found!</h4>
                      </div>
                      <div class="modal-body">
All Fields Are Mandetory                      </div>
                  </div>
              </div>
          </div>
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Success!</h4>
                      </div>
                      <div class="modal-body">
                          Information Saved Successfully.
                      </div>
                  </div>
              </div>
          </div>

    <?php
}
  


function commonHeader(){
	?>
    <header> 
      <!--top head-->
   <!--   <div class="top_head">
         <div class="container-fluid">
            <div class="pull-left"><i class="fa fa-envelope"></i><span>you@yourdomain.com</span><i class="fa fa-phone"></i><span>(888) 123-456-7890</span></div>
            <div class="pull-right text-right">
               <div class="toggle"><span><a class="trigger" href="javascript:void(0);">Sign Up</a></span><span><a class="trigger" href="javascript:void(0);">Login</a></span></div>
            </div>
         </div>
      </div>-->
      <!--navbar-->
      <nav class="navbar navbar-default">
         <div class="container-fluid"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
               <a class="navbar-brand txt_uc" href="<?php echo SECURE_PATH;?>">
               <img src="<?php echo SECURE_PATH;?>assets/images/logo.png" alt="Gool School" />
               </a></div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown "><a href="<?php echo SECURE_PATH;?>static/signup/" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                     
                  </li>
                  <li class="dropdown"><a href="<?php echo SECURE_PATH;?>static/signup/" class="dropdown-toggle" data-toggle="dropdown" role="button">Signup</a>
                     
                  </li>
                  
                  
                  
                  
               </ul>
            </div>
         </div>
      </nav>
   </header>
    <?php
}

//quickfacts
  function get_qfacts($school_code)
  {
	     global $database;

	   $_REQUEST['school_code']=$school_code;
			 //// Main Table ///
			 $query = $database->query("SELECT * FROM `school_search_info` where school_code='".$_REQUEST['school_code']."'");  
			 $data = mysqli_fetch_array($query);
			 
			 
			 			 $_SERVER['QUERY_STRING'] = 'entity_type='.$data['entity_type'].'&as_values_location='.$data['location'];

			 
			 if($data['entity_type']==0)
			 {
				 $query1 = $database->query("SELECT * FROM `school_main_info` where school_code='".$_REQUEST['school_code']."'");  
			 $data1 = mysqli_fetch_array($query1);
			 
			 if($data1['cce']!=0)
			 {
				 $cce=1;
			 }
			 else
			 {
				 				 $cce=0;

		     }
			 
			 if($data1['smc_present']==1)
			 {
				 $smc_sum=$data1['smc_parent_m']+$data1['smc_parent_f'];
				 $smc='y';
			 }
			 else
			 {
				 				 $smc='n';

		     }
			 
			 
			 $queryfty = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$_REQUEST['school_code']."'");  
			 $datafty = mysqli_fetch_array($queryfty);
			 if($datafty['playground_present']!=0)
			 {
				 $play=2;
			 }
			 else
			 {
     			 $play=0;
 
			 }
			 
			 if($datafty['no_of_computers']!=0)
			 {
				 $comp=1;
			 }
			 else
			 {
     			 $comp=0;
 
			 }
			
						 if($datafty['physics_lab']!=0)
			 {
				 $phy=1;
			 }
			 else
			 {
     			 $phy=0;
 
			 }
			 			 if($datafty['chemistry_lab']!=0)
			 {
				 $che=1;
			 }
			 else
			 {
     			 $che=0;
 
			 }
			    if(($data1['teacher_student_ratio'])<= 25) { $pt=5; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $pt=3; }
						   else if(($data1['teacher_student_ratio'])> 35) { $pt=2; }
						  
			 
			 
			 
			 $sum = $play+$comp+$phy+$che+$pt;
			 
			 
			 }
			 else
			 {
				 $query1 = $database->query("SELECT * FROM `preschool_main_info` where school_code='".$_REQUEST['school_code']."'");  
			 $data1 = mysqli_fetch_array($query1);
			 if($data1['cce']!=0)
			 {
				 $cce=1;
			 }
			 else
			 {
				 				 $cce=0;

		     }
			  if($data1['smc_present']==1)
			 {
				 $smc_sum=$data1['smc_parent_m']+$data1['smc_parent_f'];
				 $smc='y';
			 }
			 else
			 {
				 				 $smc='n';

		     }
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_facilities_info` where school_code='".$_REQUEST['school_code']."'");  
			 $datafty = mysqli_fetch_array($queryfty);
			 if($datafty['playground_present']!=0)
			 {
				 $play=2;
			 }
			 else
			 {
     			 $play=0;
 
			 }
			 
			 if($datafty['no_of_computers']!=0)
			 {
				 $comp=1;
			 }
			 else
			 {
     			 $comp=0;
 
			 }
			
						 if($datafty['physics_lab']!=0)
			 {
				 $phy=1;
			 }
			 else
			 {
     			 $phy=0;
 
			 }
			 			 if($datafty['chemistry_lab']!=0)
			 {
				 $che=1;
			 }
			 else
			 {
     			 $che=0;
 
			 }
			    if(($data1['teacher_student_ratio'])<= 25) { $pt=5; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $pt=3; }
						   else if(($data1['teacher_student_ratio'])> 35) { $pt=2; }
						  
			 
			 
			 
			 $sum = $play+$comp+$phy+$che+$pt;
			 
			 }
			 $type=$data['entity_type'];
			 /////////
			 
			 
			 
			 
			 
			 ///// user reviews///
			 
			 $queryreview = $database->query("SELECT * FROM `user_reviews` where school_code='".$_REQUEST['school_code']."'");  
			 $rows=mysqli_num_rows($queryreview);
			 //// reviews end
			 
			 //// Medium ////
			 $medium='';
			 if($data1['instruction_medium_1']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_1']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
			 if($data1['instruction_medium_2']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_2']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
if($data1['instruction_medium_3']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_3']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
if($data1['instruction_medium_4']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_4']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
			 if(strlen($medium)>0)
				 {
					 $medium = $medium;
				 }
///////////////// Medium End //////////

//// Management ////
$query3 = $database->query("SELECT * FROM `school_management_master` where id='".$data1['school_management']."'");  
			 $data3 = mysqli_fetch_array($query3);
			 $management=$data3['management'];
      ?>
       <?php  if($data['entity_type']==0)
			 {
                         ?> 
                       <li >
                             Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> 
                           </li>
                           <li >
                           <?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.
                           </li>
                           <li >
                           <?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. 
                           </li>
                           <?php
						   if($cce!=0)
						   {
							   ?>
                               <li >
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                           </li>

                               <?php
						   }
						   ?>
                                                     <?php
													 if($smc=='y')
													 {
														 ?>
                                                          <li >
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                           </li>
                                                         <?php
													 }
													 else
													 {
														 ?>
                                                          <li >
                              This school is maintained by a trust or society.                           </li>
                                                         <?php
													 }
													 ?>
                                                     
                           <li >
                           <?php if($data['num_inst_chain']<=1){ ?> This school operates  with multiple branches  and offers <?php echo $this->getMediums($_REQUEST['school_code']);?> Curriculum. <?php } else { ?>  This school operates  independently and offers <?php echo $this->getMediums($_REQUEST['school_code']);?> Curriculum. <?php } ?>
                             
                           </li>
                         
 <?php } ?>
 
 <?php  if($data['entity_type']==1)
			 {
                         ?> 
                       <li >
                             Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> 
                           </li>
                           <li >
                           <?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.
                           </li><li >
                           <?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. 
                           </li>
                           <?php
						   if($cce!=0)
						   {
							   ?>
                               <li >
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                           </li>

                               <?php
						   }
						   ?>
                                                     <?php
													 if($smc=='y')
													 {
														 ?>
                                                          <li >
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                           </li>
                                                         <?php
													 }
													 else
													 {
														 ?>
                                                          <li >
                              This school is maintained by a trust or society.                           </li>
                                                         <?php
													 }
													 ?>
                                                     
                           <li >
                              This school operates  with multiple branches  and offers <?php echo $this->getMediums($_REQUEST['school_code']);?> Curriculum. 
                           </li>
 <?php } ?>
 
      <?php
  }
function get_school_gallery($school_code){
	
	$path = "../photos/images/".$school_code."/gallery/";
	$imagearray=array();
	if(is_dir($path)){
	$files=scandir($path);

		foreach ($files as $key =>$val){
					
					if(strlen($val) >3  && $val != '.DS_Store'&& $val != 'Thumbs.db')
					{

						 $imagearray[$key] = $path.$val;

					}
		}
		
		
		return $imagearray;
	}
}
function get_school_videos($school_code){
	
	$path = "../photos/images/".$school_code."/videos/";
	$videoarray=array();
	if(is_dir($path)){
	$files=scandir($path);

		foreach ($files as $key =>$val){
					
					if(strlen($val) >3  && $val != '.DS_Store'&& $val != 'Thumbs.db')
					{

						 $videoarray[$key] = $path.$val;

					}
		}
		
		
		return $videoarray;
	}
}

function get_school_panaroma($school_code){
	
	$path = "../photos/images/".$school_code."/panorama/";
	$videoarray=array();
	if(is_dir($path)){
	$files=scandir($path);

		foreach ($files as $key =>$val){
					
					if(strlen($val) >3  && $val != '.DS_Store'&& $val != 'Thumbs.db')
					{

						 $videoarray[$key] = $path.$val;

					}
		}
		
		
		return $videoarray;
	}
}
function get_school_logo($school_code){
	
	$path =  "../photos/images/".$school_code."/logo-default/";
	
	if(is_dir($path)){
	$files=scandir($path);

		foreach ($files as $key =>$val){
					
					if(strlen($val) >3  && $val != '.DS_Store'&& $val != 'Thumbs.db')
					{
						$name = explode('.',$val);
						
					   if($name[0] == 'logo')
						return $path.$val;
						
						
					}
		}
	}
	
	return $path =  "../photos/images/logo.png";
	
}
function get_school_bcg($school_code){
	
	$path =  "../photos/images/".$school_code."/logo-default/";
	
	if(is_dir($path)){
	$files=scandir($path);

		foreach ($files as $key =>$val){
					
					if(strlen($val) >3  && $val != '.DS_Store'&& $val != 'Thumbs.db')
					{
						$name = explode('.',$val);
						
					   if($name[0] == 'default')
						return $path.$val;
						
						
					}
		}
	}
	
	return $path =  "../photos/school_bcg.jpg";
}

function getBoards($school_code){
 
 
    $board = "";
	  
	  for($i=1;$i<=4;$i++){
		  $b = $this->get_name('school_search_info','school_code',$school_code,'affiliation_board_'.$i);
		  if(strlen($b) > 0){
			  if(strlen($board) > 0)
			    $board.= ', ';
			  
			 $board.= '<a href="'.SECURE_PATH.'search/?board='.$b.'&'.$_SERVER['QUERY_STRING'].'">'.ucwords($b).'</a>';  
		  }
	  }
	
   echo $board;
  
 	
}

function getMediums($school_code){
 
 
    $med = "";
	  
	  for($i=1;$i<=4;$i++){
		   $b = $this->get_name('school_main_info','school_code',$school_code,'instruction_medium_'.$i);
		  if($b > 0){
			  if(strlen($med) > 0)
			    $med.= ', ';
			  
			 $med.= '<a href="'.SECURE_PATH.'search/?medium='.$b.'&'.$_SERVER['QUERY_STRING'].'">'.ucwords($this->get_name('instruction_medium','code',$b,'language')).'</a>';  
		  }
	  }
	
   echo $med;
   
 	
}

 /*function to get some value needed in database table*/
   function get_name($table,$column,$id,$what){
   global $database;

 $query="SELECT * FROM `".$table."` WHERE `".$column."` = '".$id."'";

    $selection = $database->query($query);

    
	$data=mysqli_fetch_array($selection);
	
	if($what != NULL){
	return $data[$what];
	}
	else{
	return $selection;
	}
  }
  
  
  
  //Routing 
  function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		 
		$base_url = $uri;
	$routes = array();
	$routes = explode('/', $base_url);
	foreach($routes as $route)
	{
		if(!trim($route) && strlen(trim($route)) > 0 && !in_array(trim($route),$routes))
			array_push($routes, $route);
	}
 
     return $routes;
 
	}
 
	
  
  
};


/**
 * Initialize session object - This must be initialized before
 * the form object because the form uses session variables,
 * which cannot be accessed unless the session has started.
 */
$session = new Session;

/* Initialize form object */
$form = new Form;

?>
