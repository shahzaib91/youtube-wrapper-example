<?php
// Load dependencies
require __DIR__.'/vendor/autoload.php';
require 'config.php';

try {
    
    // Create object
    $youtubeClient = new Mmg\Youtube\Wrapper();

    // Prepare wrapper
    $youtubeClient->prepare(APP_NAME, APP_SCOPES, APP_JSON_PATH, APP_API_KEY);

    // Check if session is present kill it
    if(!empty($_SESSION['access_token'])) {
        
        echo '<a href="kill.php">Forget active token!</a>';
        
    } else {
        
        // Display auth url
        echo '<a href="'.$youtubeClient->getAuthUrl().'">Authenticate</a>';
        
    }

} catch(Exception $e) {
    die($e->getMessage());
}

?>