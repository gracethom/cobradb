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
            $(".autoLocation").autocomplete({
                source: 'getAutoLocation.php',
                minLength: 1
            });
        });

        $(document).ready(function () {
            $(".autoseries").autocomplete({
                source: 'getautoseries.php',
                minLength: 1
            });
        });

        $(document).ready(function () {
            $(".autophysloc").autocomplete({
                source: 'getphysloc.php',
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
    <div id="wrapperHeader">
        <div id="header">
            <img src="header.jpg" alt="header" />
        </div>
    </div>
    <h1>Add a new activity record</h1>

    <!-- Dropdown to select an activity, bringing up indidvidual forms -->
    <table id="selectActivity">
        <tr>
            <td style="width:180px">
                <p>Select an activity</p>
            </td>

            <td style="width: 110px;">
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
    <!-- <div class='hidden personForm'>
        <table>
            <tr>
                <td>
                    <h3>New Person </h3>
                </td>
            </tr>
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
                    <input type="text" name="role" />
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
                <td style="width: 150px">Grade</td>
                <td style="width: 400px">
                    <input type="text" name="grade" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Race</td>
                <td style="width: 400px">
                    <input type="text" name="race" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Ethnicity</td>
                <td style="width: 400px">
                    <input type="text" name="ethnicity" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Sex</td>
                <td style="width: 400px">
                    <input type="text" name="sex" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Gender</td>
                <td style="width: 400px">
                    <input type="text" name="gender" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Occupation</td>
                <td style="width: 400px">
                    <input type="text" name="occupation" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Occupation Source</td>
                <td style="width: 400px">
                    <input type="text" name="occu_source" />
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <h3>New Location</h3>
                </td>
            </tr>
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
    </div>-->



    <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
    <!-- Located here to make it "global" and "reusable" ?? TODO -->

    <!--<div class='hidden sourceForm'>
        <table>
            <tr>
                <td>
                    <h3>New Source</h3>
                </td>
            </tr>
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
                <td style="width: 150px">Date</td>
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

    </div>-->


    <!-- TODO: reconcile individual forms with allprocess.php doc -->



    <!-- Individual forms -->



    <!-- Letter form -->

    <div class='hidden indform' id="letterForm">

        <form action="processLetter.php" method="post" />
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
        </div>
        <div class='hidden locationForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>
        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
        </div>
        <div class='hidden physLocForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
                <tr>
                    <!-- add another set of location fields -->
                    <td style="width: 150px">Location Name</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_name" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location Phone</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_phone" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Street</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_street" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">City</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_city" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">State</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_state" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Country</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_country" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Postal Code</td>
                    <td style="width: 400px">
                        <input type="text" name="loc_postal_code" />
                    </td>
                </tr>
            </table>
        </div>


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

                        <input type="text" class="autoname" name="name" />

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
        
        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Select a location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">

                        <input type="text" class="autoLocation" name="name" />

                    </td>
                </tr>

                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <button type="button" class="newLocation" onclick="newLocation()">
                            Create New Location</button>
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
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">

                        <input type="text" class="autoseries" name="name" />

                    </td>
                </tr>
                <tr>

                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">

                        <input type="text" class="autoissue" name="name" />

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
        <div class="physLocPrompt">
            <table>
                <tr>

                    <td style="width: 150px">Physical Location</td>
                    <td style="width: 400px">

                        <input type="text" class="autoPhysloc" name="name" />

                    </td>

                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <button type="button" class='newPhysLoc' onclick="newPhysLoc()">
                                Create New Physical Location</button>
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
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Review</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Title</td>
                <td style="width: 400px">
                    <input type="text" name="review_title" />
                </td>
            </tr>

            <tr>
                <td style="width:150px;vertical-align:top">Text</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 125px; width: 400px" name="review_text"></textarea>
                </td>

            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>






    <!-- Contest form -->

    <div class='hidden indform' id="contestForm">
        <form action="processContest.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Contest</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Name</td>
                <td style="width: 400px">
                    <input type="text" name="contest_name" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Affiliation</td>
                <td style="width: 400px">
                    <input type="text" name="contest_aff" />
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Description</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="contest_desc"></textarea>
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>


    <!-- Fan Club form -->

    <div class='hidden indform' id="clubForm">
        <form action="processClub.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Fan Club</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Name</td>
                <td style="width: 400px">
                    <input type="text" name="club_name" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Abbreviation</td>
                <td style="width: 400px">
                    <input type="text" name="club_abbr" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Affiliation</td>
                <td style="width: 400px">
                    <input type="text" name="club_aff" />
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>



    <!-- Meeting form -->

    <div class='hidden indform' id="meetingForm">
        <form action="processMeeting.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Meeting</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Meeting Name</td>
                <td style="width: 400px">
                    <input type="text" name="mtg_name" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Start Date</td>
                <td style="width: 400px">
                    <input type="text" name="mtg_start" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">End Date</td>
                <td style="width: 400px">
                    <input type="text" name="mtg_end" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Meeting Notes</td>
                <td style="width: 400px">
                    <input type="text" name="mtg_notes" />
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>


    <!-- Mention form -->

    <div class='hidden indform' id="mentionForm">
        <form action="processEditorial.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Mention</h3>
                </td>
            </tr>

            <tr>
                <td style="width: 150px">Mention column title</td>
                <td style="width: 400px">
                    <input type="text" name="mention_col_title" />
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Mention column description</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="mention_desc"></textarea>
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Mention notes</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="mention_notes"></textarea>
                </td>
            </tr>
        </table>
        </form>
        <input id="submit" type="submit" value="Submit" />
    </div>



    <!-- Classifieds form -->

    <div class='hidden indform' id="classifiedsForm">
        <form action="processClassifieds.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Classified</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Page title</td>
                <td style="width: 400px">
                    <input type="text" name="classified_title" />
                </td>
            </tr>

            <tr>
                <td style="width:150px;vertical-align:top">Notes</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="classified_notes"></textarea>
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>


    <!-- Pen Pals form -->
    <div class='hidden indform' id="penPalsForm">
        <form action="processPenPals.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Pen Pals</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Column title</td>
                <td style="width: 400px">
                    <input type="text" name="penpals_title" />
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Notes</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="penpals_notes"></textarea>
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>


    <!-- Traces form -->

    <div class='hidden indform' id="tracesForm">
        <form action="processTraces.php" method="post" />
        <!-- The new person form, brough up if the user clicks "Create New Person" button instead of selecting an existing person -->
        <!-- Located here to make it "global" and "reusable" ?? TODO in form_buttons.js file -->
        <div class='hidden personForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Person </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Authority</td>
                    <td style="width: 400px">
                        <input type="text" name="authority" />
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
                        <input type="text" name="role" />
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
                    <td style="width: 150px">Grade</td>
                    <td style="width: 400px">
                        <input type="text" name="grade" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Race</td>
                    <td style="width: 400px">
                        <input type="text" name="race" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Ethnicity</td>
                    <td style="width: 400px">
                        <input type="text" name="ethnicity" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Sex</td>
                    <td style="width: 400px">
                        <input type="text" name="sex" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Gender</td>
                    <td style="width: 400px">
                        <input type="text" name="gender" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation</td>
                    <td style="width: 400px">
                        <input type="text" name="occupation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Occupation Source</td>
                    <td style="width: 400px">
                        <input type="text" name="occu_source" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>New Location</h3>
                    </td>
                </tr>
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
        </div>



        <!-- The new source form, brough up if the user clicks "Create New Source" button instead of selecting an existing source -->
        <!-- Located here to make it "global" and "reusable" ?? TODO -->

        <div class='hidden sourceForm'>
            <table>
                <tr>
                    <td>
                        <h3>New Source</h3>
                    </td>
                </tr>
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
                    <td style="width: 150px">Date</td>
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

        </div>
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
                    <td style="width: 150px">Series Title</td>
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
                    <h3>Traces</h3>
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Column title</td>
                <td style="width: 400px">
                    <input type="text" name="traces_column_title" />
                </td>

                <tr>
                    <td style="width:150px;vertical-align:top">Notes</td>
                    <td style="width: 400px">
                        <textarea type="text" style="height: 50px; width: 400px" name="traces_notes"></textarea>
                    </td>
                </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>

</body>

</html>