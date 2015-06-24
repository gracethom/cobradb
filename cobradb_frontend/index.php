<html>

<head>
    <link rel="stylesheet" type="text/css" href="indexstyle.css">
    <!-- autocomplete code start-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

    <script>
        /* For javascript developer console. Function that outputs the issue information the autocomplete searches through                 (actual call commented below) */

        currentIssueArray = [];

        getAutoCompleteForIssues = function () {
            $series = $('.autoseries').val();
            $term = $('.autoissue').val();
            $data = {
                series: $series,
                term: $term
            };
            console.log($data);
            $.get('getautoissue.php', $data, function ($result) {
                console.log($result);
                currentIssueArray = $result;
                console.log(currentIssueArray);
            });
        }

        $(document).ready(function () {
            $(".autoname").autocomplete({
                source: 'getautoname.php',
                minLength: 1
            });
        });

        $(document).on('keyup', '.autoname', function () {
            $.get('getautoname.php?term=' + $(this).val(), function ($res) {
                console.log($res);
            });
        });

        $(document).ready(function () {
            $(".autoseries").autocomplete({
                source: 'getautoseries.php',
                minLength: 1
            });
        });

        $(document).ready(function () {
            $('.autoissue').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "getautoissue.php",
                        dataType: "json",
                        data: {
                            term: request.term,
                            series: $('.autoseries').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    })
                }
            })
        });


        /* For javascript developer console. Outputs the issue information the autocomplete searches through */
        $(document).on('focus keyup', '.autoissue', function () {
            if ($('.autoseries').val() != '') {
                getAutoCompleteForIssues();
            }
        });

        $(document).ready(function () {
            $("#dropdown").change(function () {
                $(".hidden").hide();
                $("#" + $(this).val()).show();
            });
        });
    </script>
    <!-- end activity type drop down menu code -->

    <!-- link to form_buttons.js and hide divs until buttons clicked -->
    <script type="text/javascript" src="form_buttons.js"></script>
    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>

</head>

<body>

    <!-- Dropdown to select an activity, bringing up indidvidual forms -->

    <table id="selectActivity">
        <tr>
            <td>
                <p>Select an activity</p>
            </td>

            <td style="width: 200px;">
                <select id='dropdown' style="width: 200px:">
                    <option> </option>
                    <option value="letterForm">Letter</option>
                    <option value="reviewForm">Review</option>
                    <option value="contestForm">Contest</option>
                    <option value="clubForm">Fan Club</option>
                    <option value="meetingForm">Meeting</option>
                    <option value="mentionForm">Mention</option>
                    <option value="classifiedsForm">Classifieds</option>
                    <option value="penPalsForm">Pen Pals</option>
                    <option value="tracesForm">Traces</option>
                </select>
            </td>
        </tr>
    </table>


    <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
    <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
    <div class='hidden personForm'>
        <h3>Person information</h3>
        <p>Surname
            <input type="text" name="surname" />
        </p>
        <p>Forename
            <input type="text" name="forename" />
        </p>
        <p>Title
            <input type="text" name="pers_title" />
        </p>
        <p>Role
            <input type="text" name="role" />
        </p>
        <p>Alternate name
            <input type="text" name="alt_name" />
        </p>
        <p>Birth year
            <input type="text" name="birth_year" />
        </p>
        <p>Birth year source
            <input type="text" name="byear_source" />
        </p>
        <p>Grade
            <input type="text" name="grade" />
        </p>
        <p>Race
            <input type="text" name="race" />
        </p>
        <p>Ethnicity
            <input type="text" name="ethnicity" />
        </p>
        <p>Sex
            <input type="text" name="sex" />
        </p>
        <p>Gender
            <input type="text" name="gender" />
        </p>
        <p>Occupation
            <input type="text" name="occupation" />
        </p>
        <p>Occupation Source
            <input type="text" name="occu_source" />
        </p>
        <br/>
        <h3>Location information</h3>
        <p>Street
            <input type="text" name="street" />
        </p>
        <p>City
            <input type="text" name="city" />
        </p>
        <p>State
            <input type="text" name="state" />
        </p>
        <p>Country
            <input type="text" name="country" />
        </p>
        <p>Zipcode
            <input type="text" name="zipcode" />
        </p>
    </div>



    <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
    <!-- Located here to make it "global" and "reusable" ?? TODO -->

    <div class='hidden sourceForm'>
        <h3>Source</h3>
        <p>Source type
            <input type="text" name="source_type" />
        </p>
        <p>GCD Link (or however this will work)
            <input type="text" name="gcd_link" />
        </p>
        <p>Series Name
            <input type="text" name="series_name" />
        </p>
        <p>Issue Number
            <input type="text" name="issue_num" />
        </p>
        <p>Date
            <input type="text" name="date" />
        </p>
        <p>Page Number
            <input type="text" name="page_num" />
        </p>

    </div>






    <!-- Individual forms -->



    <!-- Letter form -->

    <div class='hidden indform' id="letterForm">

        <form action="processLetter.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Select a person</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Name</td>
                    <td style="width: 400px">
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Select a source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Name</td>
                    <td style="width: 400px">
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <td>
                    <h3>Letter</h3>
                </td>
            </tr>
            <tr>
                <td style="width:150px">Unique title</td>
                <td style="width: 400px">
                    <input type="text" name="letter_title" />
                </td>
            </tr>
            <tr>
                <td style="width:150px">Salutation</td>
                <td style="width: 400px">
                    <input type="text" name="salutation" />
                </td>
            </tr>
            <tr>
                <td style="width:150px">Closing</td>
                <td style="width: 400px">
                    <input type="text" name="closing" />
                </td>
            </tr>
            <tr>
                <td style="width:150px">Letter page title</td>
                <td style="width: 400px">
                    <input type="text" name="letter_pg_title" />
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Text</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 125px; width: 400px" name="letter_text"></textarea>
                </td>
            </tr>

        </table>

        <input id="submit" type="submit" value="Submit" />
        </form>

    </div>





    <!-- Review form -->

    <div class='hidden indform' id="reviewForm">
        <form action="processReview.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Review</h3>
            </tr>
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="review_title" />
                </td>
            </tr>

            <tr>
                <td>Text</td>
                <td>
                    <input type="text" name="review_text" />
                </td>

            </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>






    <!-- Contest form -->

    <div class='hidden indform' id="contestForm">
        <form action="processContest.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Contests</h3>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="contest_name" />
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <input type="text" name="contest_desc" />
                </td>
            </tr>

            <tr>
                <td>Affiliation</td>
                <td>
                    <input type="text" name="contest_aff" />
                </td>
            </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Fan Club form -->

    <div class='hidden indform' id="clubForm">
        <form action="processClub.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Fan Club</h3>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="club_name" />
                </td>
            </tr>
            <tr>
                <td>Abbreviation</td>
                <td>
                    <input type="text" name="club_abbr" />
                </td>
            </tr>
            <tr>
                <td>Affiliation</td>
                <td>
                    <input type="text" name="club_aff" />
                </td>
            </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>



    <!-- Meeting form -->

    <div class='hidden indform' id="meetingForm">
        <form action="processMeeting.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Meeting</h3>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="mtg_name" />
                </td>
            </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Mention form -->

    <div class='hidden indform' id="mentionForm">
        <form action="processEditorial.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Mention</h3>
            </tr>

            <tr>
                <td>Mention column title</td>
                <td>
                    <input type="text" name="mention_col_title" />
                </td>
            </tr>
            <tr>
                <td>Mention column description</td>
                <td>
                    <input type="text" name="mention_desc" />
                </td>
            </tr>
        </table>
        </form>
        <input type="submit" value="Submit" />
    </div>



    <!-- Classifieds form -->

    <div class='hidden indform' id="classifiedsForm">
        <form action="processClassifieds.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Classified</h3>
                <tr>
                    <tr>
                        <td>Page title</td>
                        <td>
                            <input type="text" name="classified_title" />
                        </td>

                        <tr>
                            <td>Information</td>
                            <td>
                                <input type="text" name="classified_info" />
                            </td>
                        </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Pen Pals form -->
    <div class='hidden indform' id="penPalsForm">
        <form action="processPenPals.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>
        <table>
            <tr>
                <h3>Pen Pals</h3>
            </tr>
            <tr>
                <td>Column title</td>
                <td>
                    <input type="text" name="penpals_title" />
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <input type="text" name="penpals_desc" />
                </td>
            </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Traces form -->

    <div class='hidden indform' id="tracesForm">
        <form action="processTraces.php" method="post" />

        <div class="personPrompt">
            <table>
                <tr>
                    <h3>Select a person</h3>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoname" name="name" />
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>or</td>
                    <td>
                        <button type="button" class="newPerson" onclick="newPerson()">
                            Create New Person</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <h3>Select a source</h3>
                </tr>
                <tr>
                    <td>Series Name</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoseries" name="name" />
                        </form>
                    </td>
                </tr>
                <tr>

                    <td>Issue</td>
                    <td>
                        <form method="post" action="">
                            <input type="text" class="autoissue" name="name" />
                        </form>
                    </td>

                    <tr>
                        <td>or</td>
                        <td>
                            <button type="button" class='newSource' onclick="newSource()">
                                Create New Source</button>
                        </td>
                    </tr>

                </tr>
            </table>
        </div>

        <table>
            <tr>
                <h3>Traces</h3>
            </tr>
            <tr>
                <td>Column title</td>
                <td>
                    <input type="text" name="traces_column_title" />
                </td>

                <tr>
                    <td>Description</td>
                    <td>
                        <input type="text" name="traces_desc" />
                    </td>
                </tr>
        </table>
        <input type="submit" value="Submit" />
        </form>
    </div>

</body>

</html>