<?php
### *** DON'T REMOVE/CHANGE THIS LINE *** ###
session_start();

### DEFINE APP NAME ###
define('APP_NAME', '{VALUE}');

### DEFINE API SCOPES ###
### We are using only these two for more scopes refer to the link ###
### https://developers.google.com/identity/protocols/oauth2/scopes#youtube ###
define('APP_SCOPES',[
    // General API operations
    'https://www.googleapis.com/auth/youtube.readonly',
    // Needed for the comments
    'https://www.googleapis.com/auth/youtube.force-ssl'
]);

### DEFINE JSON FILE PATH OBTAINED FROM GOOGLE ###
define('APP_JSON_PATH', '{VALUE}');

### DEFINE API KEY OBTAINED FROM GOOGLE ###
define('APP_API_KEY', '{VALUE}');