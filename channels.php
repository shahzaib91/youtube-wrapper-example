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
    
    // Set or refresh token 
    $accessToken = $youtubeClient->setAccessToken($_SESSION['access_token']);
    $_SESSION['access_token'] = json_encode($accessToken);
    
    // Get channels list
    $channels = $youtubeClient->getChannelsList();
    
} catch(Exception $e) {
    die($e->getMessage());
}


// Table tag opening
echo 
'
    <table style="width:50%; margin: 20px auto;" border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th colspan="3">
                    <h1><a href="index.php">Back to Authentication</h1>
                </th>
            </tr>
            <tr>
                <th>S#</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
';

// Conditional data rendering logic
if(count($channels)> 0 ) {
    
    for($i = 0 ; $i < count($channels); $i++) {
        echo
        '
            <tr>
                <td style="text-align:center">
                    '.($i+1).'
                </td>
                <td>
                    <br />
                    <div><strong>'.$channels[$i]['name'].'</strong></div>
                    <div>
                        <a target="_blank" href="https://www.youtube.com/'.$channels[$i]['username'].'">
                            <small>'.$channels[$i]['username'].'</small>
                        </a>
                    </div>
                    <br/>
                    <div>
                        <small style="background: #FF0000; color: #fff; padding: 5px; font-family: tahoma;">
                            Followers (<strong>'.$channels[$i]['subscribers'].'</strong>)
                        </small>
                        &nbsp;
                        <small style="background: #E5E5E5; color: #000; padding: 5px; font-family: tahoma;">
                            Plays (<strong>'.$channels[$i]['total_plays'].'</strong>)
                        </small>
                        &nbsp;
                        <small style="background: #E5E5E5; color: #000; padding: 5px; font-family: tahoma;">
                            Created At (<strong>'.date('d M Y', strtotime($channels[$i]['created_at'])).'</strong>)
                        </small>
                    </div>
                    <br />
                </td>
                <td style="text-align:center">
                    <button onclick="window.location=\'videos.php?channel='.$channels[$i]['id'].'\'" type="button">
                        Access Channel
                    </button
                </td>
            </tr>
        ';
    }
    
} else {
    
    echo
    '
        <tr>
            <td colspan="3"> No data to display! </td>
        </tr>
    ';
    
}


// Table tag closing
echo 
'
        </tbody>
    </table>
';
?>