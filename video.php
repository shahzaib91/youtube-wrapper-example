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
    if(empty($_GET['v'])){
        header('Location: videos.php');
    }
    
    // Set or refresh token 
    $accessToken = $youtubeClient->setAccessToken($_SESSION['access_token']);
    $_SESSION['access_token'] = json_encode($accessToken);
    
    // Get channels list
    $video = $youtubeClient->getVideoDetail($_GET['v']);
    
    // Table tag opening
    echo 
    '
        <table style="width:50%; margin: 20px auto;" border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>
                        <h1><a href="channels.php">Back to Channels</h1>
                    </th>
                </tr>
                <tr>
                    <th>
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$_GET['v'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </th>
                </tr>
                <tr>
                    <td>
                        <h3>'.$video['title'].'</h3>
                        <p>
                            <small>
                                Uploaded On: '.date('d M Y, h:i A', strtotime($video['created_at'])).' | 
                                Uploaded By: '.$video['channel_name'].' | 
                                Likes: '.$video['stats']['likes'].' | 
                                Dislikes: '.$video['stats']['dislikes'].' | 
                                Favorites: '.$video['stats']['favorites'].' | 
                                Comments: '.$video['stats']['comments'].' 
                            </small>
                        </p>
                        <p>'.$video['description'].'</p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h3>Comments ('.$video['stats']['comments'].' )</h3>
                    </td>
                </tr>
    ';

    // Render comments
    if(!empty($video['stats']['comments']) && $video['stats']['comments'] > 0) {
        foreach($video['comments'] as $comment) {
            echo
            '
                <tr>
                    <td>
                        <div style="width:15%;  float:left;">
                            <img src="'.$comment['author_image'].'" style="width:100%" />
                        </div>
                        <div style="width:80%; padding-left:3%; float:left;">
                            <p><strong>'.$comment['author'].'</strong></p>
                            <p><small>Posted on: <strong>'.date('M d, Y h:i A', strtotime($comment['updated_at'])).'</strong></small></p>
                            <p>'.$comment['text'].'</p>
                        </div>
                    </td>
                </tr>
            ';
            
            // Render replies
            if(!empty($comment['replies_count']) && $comment['replies_count'] > 0) {
                
                echo 
                '
                    <tr>
                        <td>
                            <div style="padding-left:50px">
                ';
                
                foreach($comment['replies'] as $replies) {
                    echo
                    '
                        <div>
                            <div style="width:15%;  float:left;">
                                <img src="'.$replies['author_image'].'" style="width:100%" />
                            </div>
                            <div style="width:80%; padding-left:3%; float:left;">
                                <p><strong>'.$replies['author'].'</strong></p>
                                <p><small>Posted on: <strong>'.date('M d, Y h:i A', strtotime($replies['updated_at'])).'</strong></small></p>
                                <p>'.$replies['text'].'</p>
                            </div>
                        </div>
                    ';
                }
                
                echo 
                '
                            </div>
                        </td>
                    </tr>
                ';
            }
        }
    } else {
        echo 
        '
            <tr>
                <td>
                    No comments to display!
                </td>
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