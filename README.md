<h3>Background</h3>
<p>This is a sample code to test the "Youtube Wrapper Class", written in "Core PHP" with a very simple and minimal UI. It asks you to authenticate with one of your "Youtube accounts". Once authenticated, you can see your channel and videos along with likes, comments, dislikes and comment replies.</p>
<h3>Setup</h3>
<ul>
    <li>Run the command: <code>git clone https://github.com/shahzaib91/youtube-wrapper-example.git</code> to download this repo.</li>
    <li>Run the command: <code>composer install</code> to download dependencies.</li>
    <li>Configure "config.php" file.</li>
    <li>Start exploring features using UI.</li>
</ul>
<h3>Files Description</h3>
<table style="width:100%" border="1" cellpadding="2" cellspacing="0">
    <thead>
        <tr>
            <th>File Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>auth-response.php</td>
            <td>
                This file is responsible for listening to the redirect call after successful login. This file must be specified in the "Google Developer Console".
            </td>
        </tr>
        <tr>
            <td>channels.php</td>
            <td>
                View the channel associated with your account along with the number of followers and video views.
            </td>
        </tr>
        <tr>
            <td>config.php</td>
            <td>
                Global configuration file.
            </td>
        </tr>
        <tr>
            <td>index.php</td>
            <td>
                Starting point.
            </td>
        </tr>
        <tr>
            <td>kill.php</td>
            <td>
                After authentication, your access token is stored in the session variable, as no persistent storage is used in this sample code. If you want to change your account, this file will help you terminate the session and allow you to authenticate with another account.
            </td>
        </tr>
        <tr>
            <td>videos.php</td>
            <td>
                List top 12 videos from your channel.
            </td>
        </tr>
        <tr>
            <td>video.php</td>
            <td>
                Detail view of the video where you can play the video and read comments and other metadata about the video.
            </td>
        </tr>
    </tbody>
</table>