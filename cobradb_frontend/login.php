<?php /** * Copyright (C) 2013 peredur.net * * This program is free software: you can redistribute it and/or modify * it under the terms of the GNU General Public License as published by * the Free Software Foundation, either version 3 of the License, or * (at your option) any later version. * * This program is distributed in the hope that it will be useful, * but WITHOUT ANY WARRANTY; without even the implied warranty of * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the * GNU General Public License for more details. * * You should have received a copy of the GNU General Public License * along with this program. If not, see <http://www.gnu.org/licenses/>. */ include_once 'includes/db_connect.php'; include_once 'includes/functions.php'; sec_session_start(); if (login_check($mysqli) == true) { $logged = 'in'; } else { $logged = 'out'; } ?>
<html>
<head>
    <title>CoBRA | Log In</title>
            <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" type="text/css" href="indexstyle.css">
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
</head>

<body>
    <?php if (isset($_GET[ 'error'])) { echo '<p class="error">Error Logging In!</p>'; } ?>
    <div id="wrapperHeader">
        <div id="header">
            <img src="header.jpg" alt="header" />
        </div>
    </div>
    <div>
        <form action="includes/process_login.php" method="post" name="login_form">
            <table>
                <tr>
                    <td style="width: 100px">Email</td>
                    <td style="width: 300px">
                        <input type="text" name="email" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px; background: white">Password</td>
                    <td style="width: 300px; background: white">
                        <input type="password" name="password" id="password" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px"></td>
                    <td style="width: 300px">
                        <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>