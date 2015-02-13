<?php
require_once('functions.php');
$current="Nyhetsbrev";
require_once('header.php');
?>
<div id="wrapper">
    <div id="wrapcenter">
        <div id="leftmenu">
            <ul>
                <li><a href="newsletter.php">Nytt nyhetsbrev</a></li>
                <li><a href="oldnewsletter.php">Tidigare nyhetsbrev</a></li>
            </ul>
        </div>
        <div id="listcontent">
            <h1 class="newproduct">Skriv nytt nyhetsbrev</h1>
            <p></p>
            <div id="news_sub">
                <p>&Auml;mne:</p>
                <input type="text" class="newslettersubject" id="contact_message">
                <p>Meddelande:</p>
                <textarea class="newsletter" id="contact_name"></textarea><br />
                <input type="submit" value="Skicka nyhetsbrev" onClick="sendMessage();">
                <div id="message_sent" style="display: none;">
                    <img src="checkmark.png"><span class="answer">Nyhetsbrevet har skickats.</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>