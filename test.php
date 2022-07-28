//for phone number ^[0-9]{10}$
//for full name ^[A-Za-z. ]{3,30}$
//for username ^[A-Za-z0-9]{3,10}$
//for email ^[A-Za-z0-9_.]{3,}@[A-Za-z]{3,}\.[A-Za-z.]{2,6}$
//for password ^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])[A-Za-z0-9!@#\$%\^&\*]{8,16}$
// 1 week = 604800 seconds
// server should keep session data for exactly (or at least) 1 week
<!-- ini_set('session.gc_maxlifetime', 604800); -->
// each client should remember their session id for EXACTLY 1 week
<!-- session_set_cookie_params(604800); -->
<!-- session_start();  -->
// start the session