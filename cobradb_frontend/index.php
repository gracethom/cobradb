<html>

<head>

    <!-- autocomplete code start-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

    <script>
        /* For javascript developer console. Function that outputs the issue information the autocomplete searches through                 (actual call commented below) */

        currentIssueArray = [];

        getAutoCompleteForIssues = function () {
            $series = $('#autoseries').val();
            $term = $('#autoissue').val();
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
            $("#autoname").autocomplete({
                source: 'getautoname.php',
                minLength: 1
            });
        });
        
        $(document).on('keyup', '#autoname', function(){
                $.get('getautoname.php?term=' + $(this).val(), function($res){
                    console.log($res);
                });
            });

        $(document).ready(function () {
            $("#autoseries").autocomplete({
                source: 'getautoseries.php',
                minLength: 1
            });
        });

        $(document).ready(function () {
            $('#autoissue').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "getautoissue.php",
                        dataType: "json",
                        data: {
                            term: request.term,
                            series: $('#autoseries').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    })
                }
            })
        });


        /* For javascript developer console. Outputs the issue information the autocomplete searches through */
        $(document).on('focus keyup', '#autoissue', function () {
            if ($('#autoseries').val() != '') {
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
    <h2>Select an activity</h2>

    <select id='dropdown'>
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

    <br />
    <br />


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

    <div class='hidden' id="letterForm">
        <form action="processLetter.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>


        <h3>Letter</h3>
        <p>Unique title
            <input type="text" name="letter_title" />
        </p>
        <p>Salutation
            <input type="text" name="salutation" />
        </p>
        <p>Closing
            <input type="text" name="closing" />
        </p>
        <p>Text
            <input type="text" name="letter_text" />
        </p>
        <p>Letter page title
            <input type="text" name="letter_pg_title" />
        </p>

        <input type="submit" value="Submit" />
        </form>
    </div>





    <!-- Review form -->

    <div class='hidden' id="reviewForm">
        <form action="processReview.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Review</h3>
        <p>Title
            <input type="text" name="review_title" />
        </p>
        <p>Text
            <input type="text" name="review_text" />
        </p>

        <input type="submit" value="Submit" />
        </form>
    </div>






    <!-- Contest form -->

    <div class='hidden' id="contestForm">
        <form action="processContest.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Contests</h3>
        <p>Name
            <input type="text" name="contest_name" />
        </p>
        <p>Description
            <input type="text" name="contest_desc" />
        </p>
        <p>Affiliation
            <input type="text" name="contest_aff" />
        </p>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Fan Club form -->

    <div class='hidden' id="clubForm">
        <form action="processClub.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Fan Club</h3>
        <p>Name
            <input type="text" name="club_name" />
        </p>
        <p>Abbreviation
            <input type="text" name="club_abbr" />
        </p>
        <p>Affiliation
            <input type="text" name="club_aff" />
        </p>
        <input type="submit" value="Submit" />
        </form>
    </div>



    <!-- Meeting form -->

    <div class='hidden' id="meetingForm">
        <form action="processMeeting.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Meeting</h3>
        <p>Name
            <input type="text" name="mtg_name" />
        </p>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Mention form -->

    <div class='hidden' id="mentionForm">
        <form action="processEditorial.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Mention</h3>
        <input type="submit" value="Submit" />
        <p>Mention column title
            <input type="text" name="mention_col_title" />
        </p>
        <p>Mention column description
            <input type="text" name="mention_desc" />
        </p>
        </form>
    </div>



    <!-- Classifieds form -->

    <div class='hidden' id="classifiedsForm">
        <form action="processClassifieds.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Classified</h3>
        <p>Page title
            <input type="text" name="classified_title" />
        </p>
        <p>Information
            <input type="text" name="classified_info" />
        </p>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Pen Pals form -->
    <div class='hidden' id="penPalsForm">
        <form action="processPenPals.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Pen Pals</h3>
        <p>Column title
            <input type="text" name="penpals_title" />
        </p>
        <p>Description
            <input type="text" name="penpals_desc" />
        </p>
        <input type="submit" value="Submit" />
        </form>
    </div>


    <!-- Traces form -->

    <div class='hidden' id="tracesForm">
        <form action="processTraces.php" method="post" />

        <div class="personPrompt">
            <h3>Select a person</h3>
            <form method="post" action="">
                Name :
                <input type="text" class="autoname" name="name" />
            </form>
            <p>or
                <button type="button" class="newPerson" onclick="newPerson()">
                    Create New Person</button>
            </p>
        </div>

        <div class="sourcePrompt">
            <h3>Select a source</h3>
            <form method="post" action="">
                Series Name :
                <input type="text" class="autoseries" name="name" />
            </form>
            <form method="post" action="">
                Issue :
                <input type="text" class="autoissue" name="name" />
            </form>
            <p>or
                <button type="button" class='newSource' onclick="newSource()">
                    Create New Source</button>
            </p>
        </div>

        <h3>Traces</h3>
        <p>Column title
            <input type="text" name="traces_column_title" />
        </p>
        <p>Description
            <input type="text" name="traces_desc" />
        </p>
        <input type="submit" value="Submit" />
        </form>
    </div>

</body>

</html>