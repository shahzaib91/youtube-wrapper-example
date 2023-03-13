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
    if(empty($_SESSION['access_token'])) {
        header('Location: index.php');
    }
    
    // Redirect if empty or no channel id
    if(empty($_GET['channel'])){
        header('Location: channels.php');
    }
    
    // Set or refresh token 
    $accessToken = $youtubeClient->setAccessToken($_SESSION['access_token']);
    $_SESSION['access_token'] = json_encode($accessToken);
    
    // Get channels list
    $videos = $youtubeClient->getVideosList($_GET['channel']);
    
    // Table tag opening
    echo 
    '
        <table style="width:50%; margin: 20px auto;" border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th colspan="2">
                        <h1><a href="channels.php">Back to Channels</h1>
                    </th>
                </tr>
                <tr>
                    <th>Thumbnail</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
    ';

    // Conditional data rendering logic
    if(count($videos)> 0 ) {
        
        for($i = 0 ; $i < count($videos); $i++) {
            echo
            '
                <tr>
                    <td style="text-align:center">
                        <img src="'.$videos[$i]['thumbnail'].'" />
                    </td>
                    <td>
                        <br />
                        <div><strong>'.$videos[$i]['title'].'</strong></div>
                        <div>
                            <small style="font-weight:bold; padding-top:5px; display:inline-block">'.$videos[$i]['channel_name'].'</small>
                        </div>
                        <div>
                            <small style="font-weight:bold; padding-top:5px; display:inline-block">'.date('d M Y, h:i A', strtotime($videos[$i]['created_at'])).'</small>
                        </div>
                        <br/>
                        <div>
                            <p>
                            '.$videos[$i]['description'].'
                            </p>
                            <a href="video.php?v='.$videos[$i]['id'].'" style="background: #FF0000; text-decoration:none; color: #fff; padding: 5px; font-family: tahoma; display:block; text-align:center;">
                                Watch Video
                            </a>
                        </div>
                        <br />
                    </td>
                </tr>
            ';
        }
        
    } else {
        
        echo
        '
            <tr>
                <td colspan="2"> No data to display! </td>
            </tr>
        ';
        
    }


    // Table tag closing
    echo 
    '
            </tbody>
        </table>
    ';
    
} catch(Exception $e) {
    die($e->getMessage());
}



?>