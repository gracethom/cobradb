<html>

<head>
    <link rel="stylesheet" type="text/css" href="indexstyle.css">

    <script src="scripts/jquery-1.8.3.min.js"></script>
    <script src="src/jquery.modal.js"></script>
    <script src="scripts/application.js"></script>

    <script></script>
</head>

<body>
    <div id="wrapperHeader">
        <div id="header">
            <img src="header.jpg" alt="header" />
        </div>
    </div>

    <div>

        <form action="processes/loginProcess.php" method="post">
            <table>
                <tr class="login">
                    <td style="width: 150px">Username</td>
                    <td style="width: 400px">
                        <input type="text" name="user" />
                    </td>
                </tr>
                <tr class="login">
                    <td style="width: 150px">Password</td>
                    <td style="width: 400px">
                        <input type="text" name="pass" />
                    </td>
                </tr>
            </table>
        </div>
    <input id="submit" type="submit" value="Log In" />
        </form>


        
</body>

</html>