<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<section class="form" data-action="processes/personProcess.php">
    <table>
        <tr>
            <td style="width: 150px">Authority</td>
            <td style="width: 400px">
                <input type="text" name="pers_auth" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Surname</td>
            <td style="width: 400px">
                <input type="text" name="surname" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Forename</td>
            <td style="width: 400px">
                <input type="text" name="forename" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Title</td>
            <td style="width: 400px">
                <input type="text" name="pers_title" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Role</td>
            <td style="width: 400px">
                <input type="text" name="pers_role" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Alternate name</td>
            <td style="width: 400px">
                <input type="text" name="alt_name" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Birth year</td>
            <td style="width: 400px">
                <input type="text" name="birth_year" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Birth year source</td>
            <td style="width: 400px">
                <input type="text" name="byear_source" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Gender Note</td>
            <td style="width: 400px">
                <input type="text" name="gender_note" />
            </td>
        </tr>

        <tr>
            <td style="width: 150px">Race</td>
            <td style="width: 400px">
                <input type="text" name="race" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Race Note</td>
            <td style="width: 400px">
                <input type="text" name="race_note" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Ethnicity</td>
            <td style="width: 400px">
                <input type="text" name="ethnicity" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Ethnicity Note</td>
            <td style="width: 400px">
                <input type="text" name="ethnicity_note" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Occupation</td>
            <td style="width: 400px">
                <input type="text" name="occupation" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Occupation Note</td>
            <td style="width: 400px">
                <input type="text" name="occu_note" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Grade</td>
            <td style="width: 400px">
                <input type="text" name="grade" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Grade Note</td>
            <td style="width: 400px">
                <input type="text" name="grade_note" />
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