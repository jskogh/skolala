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
            <h1 class="newproduct">Tidigare nyhetsbrev</h1>
            <p></p>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Nyhetsbrevs-ID</th>
                    <th class="allproducts" style="width:120px;text-align: center;">&Auml;mne</th>
                    <th class="allproducts" style="width:200px;text-align: center;">Status</th>
                    <th class="allproducts" style="width:180px;text-align: center;">Skickat den</th>
                </tr>
                <tr>
                    <td><a href="#" onclick="contactCustomer('4');">4</a></td>
                    <td>Alla hj&auml;rtans dag-yra!</td>
                    <td>Skickat</td>
                    <td>2014-02-10</td>
                </tr>
                <tr id="4" style="display: none;width: 100%;background-color: rgba(88, 183, 126, 0.1);">
                    <td colspan="9">
                        <div style="display: block;padding:40px;width:900px;margin: 0 auto;text-align: left;">
                            <h1>Nyhetsbrev 4: Alla hj&auml;rtans dag-yra!</h1>
                            <p>Nu n&auml;r sn&ouml;n har kommit &auml;r det dags att se &ouml;ver skof&ouml;rr&aring;det igen.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="contactCustomer('3');">3</a></td>
                    <td>Kavatjanuari!</td>
                    <td>Skickat</td>
                    <td>2014-01-04</td>
                </tr>
                <tr id="3" style="display: none;width: 100%;background-color: rgba(88, 183, 126, 0.1);">
                    <td colspan="9">
                        <div style="display: block;padding:40px;width:900px;margin: 0 auto;text-align: left;">
                            <h1>Nyhetsbrev 3: Kavatjanuari!</h1>
                            <p>Nu n&auml;r sn&ouml;n har kommit &auml;r det dags att se &ouml;ver skof&ouml;rr&aring;det igen.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="contactCustomer('2');">2</a></td>
                    <td>Mellandagsrea</td>
                    <td>Skickat</td>
                    <td>2014-12-25</td>
                </tr>
                <tr id="2" style="display: none;width: 100%;background-color: rgba(88, 183, 126, 0.1);">
                    <td colspan="9">
                        <div style="display: block;padding:40px;width:900px;margin: 0 auto;text-align: left;">
                            <h1>Nyhetsbrev 2: Mellandagsrea</h1>
                            <p>Nu n&auml;r sn&ouml;n har kommit &auml;r det dags att se &ouml;ver skof&ouml;rr&aring;det igen.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><a href="#" onclick="contactCustomer('1');">1</a></td>
                    <td>Julnyheter</td>
                    <td>Skickat</td>
                    <td>2014-12-12</td>
                </tr>
                <tr id="1" style="display: none;width: 100%;background-color: rgba(88, 183, 126, 0.1);">
                    <td colspan="9">
                        <div style="display: block;padding:40px;width:900px;margin: 0 auto;text-align: left;">
                            <h1>Nyhetsbrev 1: Julnyheter</h1>
                            <p>Nu n&auml;r sn&ouml;n har kommit &auml;r det dags att se &ouml;ver skof&ouml;rr&aring;det igen.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>