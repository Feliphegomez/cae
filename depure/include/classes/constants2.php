<?php
define("DB_SERVER", "mysql11.000webhost.com");
define("DB_USER", "a8411780_caeuser");
define("DB_PASS", "deMedallo.");
define("DB_NAME", "a8411780_cae");
define("TBL_USERS", "users");
define("TBL_ACTIVE_USERS",  "active_users");
define("TBL_ACTIVE_GUESTS", "active_guests");
define("TBL_BANNED_USERS",  "banned_users");
define("ADMIN_NAME", "admin");
define("GUEST_NAME", "Guest");   
define("ADMIN_LEVEL", 9);
define("MASTER_LEVEL", 8);
define("AGENT_LEVEL",  1); 
define("AGENT_MEMBER_LEVEL", 2); 
define("GUEST_LEVEL", 0);        
define("TRACK_VISITORS", true);
define("USER_TIMEOUT", 10);
define("GUEST_TIMEOUT", 5);
define("COOKIE_EXPIRE", 60*60*24*30);  //100 days by default (*30)
define("COOKIE_PATH", "/");  //Avaible in whole domain
define("EMAIL_FROM_NAME", "Create by FelipheGomez");
define("EMAIL_FROM_ADDR", "feliphegomez@demedallo.com");
define("EMAIL_WELCOME", false);
define("ALL_LOWERCASE", false);
?>
