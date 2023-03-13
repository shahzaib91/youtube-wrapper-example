<?php
// Load dependencies
require __DIR__.'/vendor/autoload.php';
require 'config.php';

try {
    
    // Create object
    $youtubeClient = new Mmg\Youtube\Wrapper();

    // Prepare wrapper
    $youtubeClient->prepare(APP_NAME, APP_SCOPES, APP_JSON_PATH, APP_API_KEY);
    
    // Redirect if we already have token
    if(!empty($_SESSION['access_token'])) {
        header('Location: channels.php');
    }

    // Fetch access token
    if(!empty($_GET['code']) && empty($_SESSION['access_token'])) {
        $accessToken = $youtubeClient->getAccessToken($_GET['code']);
        $_SESSION['access_token'] = json_encode($accessToken);
        
        // Redirect after setting access token to session
        header('Location: channels.php');
    }
    
} catch(Exception $e) {
    die($e->getMessage());
}
?>