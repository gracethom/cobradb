<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<section class="form" data-action="processes/sourceProcess.php">
    <table>
        <tr>
            <td style="width: 150px">Source type</td>
            <td style="width: 400px">
                <input type="text" name="source_type" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">GCD Link</td>
            <td style="width: 400px">
                <input type="text" name="gcd_link" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Series Title</td>
            <td style="width: 400px">
                <input type="text" name="series_title" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Issue Number</td>
            <td style="width: 400px">
                <input type="text" name="issue_num" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Publication Date</td>
            <td style="width: 400px">
                <input type="text" name="pub_date" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Page Number</td>
            <td style="width: 400px">
                <input type="text" name="page_num" />
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