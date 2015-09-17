<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<section class="form" data-action="processes/locationProcess.php">
    <table>
        <tr>
            <td style="width: 150px">Street</td>
            <td style="width: 400px">
                <input type="text" name="street" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">City</td>
            <td style="width: 400px">
                <input type="text" name="city" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">State</td>
            <td style="width: 400px">
                <input type="text" name="state" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Country</td>
            <td style="width: 400px">
                <input type="text" name="country" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Postal Code</td>
            <td style="width: 400px">
                <input type="text" name="postal_code" />
            </td>
        </tr>
    </table>
    <button class="submitForm">Submit</button>
</section>

<?php else : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="/cobradb_copy/login.php">login</a>.
    </p>
    <?php endif; ?>