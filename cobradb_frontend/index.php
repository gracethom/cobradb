<?php include_once 'includes/db_connect.php'; include_once 'includes/functions.php'; sec_session_start(); ?>


<html>

<head>
    <link rel="stylesheet" type="text/css" href="indexstyle.css">

    <script src="scripts/jquery-1.8.3.min.js"></script>
    <script src="src/jquery.modal.js"></script>
    <script src="scripts/application.js"></script>



    <!-- leave in this order for successful autocomplete!!! -->
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" /></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>



    <script>
        currentIssueArray = [];

        getAutoCompleteForIssues = function () {
            $series = $('#selectedSeries').val();
            $term = $('.autoIssue').val();
            $data = {
                series: $series,
                term: $term
            };
            console.log($data);
            $.get('autocompletes/getAutoIssue.php', $data, function ($result) {
                console.log($result);
                currentIssueArray = $result;
                console.log(currentIssueArray);
            });
        }

        $(document).ready(function () {

            $("#dropdown").change(function () {
                $(".hidden").hide();
                $("#" + $(this).val()).show();
            });

            $(".autoName").autocomplete({
                source: 'autocompletes/getAutoName.php',
                minLength: 1
            });

            $(".autoLocation").autocomplete({
                source: 'autocompletes/getAutoLocation.php',
                minLength: 1
            });

            $(".autoSeries").autocomplete({
                source: 'autocompletes/getAutoSeries.php',
                minLength: 1
            });

            $(".autoPhysLoc").autocomplete({
                source: 'autocompletes/getAutoPhysLoc.php',
                minLength: 1
            });

            $('.autoIssue').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "autocompletes/getAutoIssue.php",
                        dataType: "json",
                        data: {
                            term: request.term,
                            series: $('.autoSeries').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    })
                }
            });

        });

        $(document).on('keyup', '.autoName', function () {
            $.get('autocompletes/getAutoName.php?term=' + $(this).val(), function ($res) {
                console.log($res);
            });
        });

        $(document).on('keyup', '.autoLocation', function () {
            $.get('autocompletes/getAutoLocation.php?term=' + $(this).val(), function ($res) {
                console.log($res);
            });
        });


        $(document).on('focus keyup', '.autoIssue', function () {
            if ($('.autoSeries').val() != '') {
                getAutoCompleteForIssues();
            }
        });


        $('.form').openModal();
    </script>


    <!-- hide divs until buttons clicked -->
    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>

</head>

<body>
    <?php if (login_check($mysqli)==true) : ?>



    <div id="wrapperHeader">
        <div id="header">
            <img src="header.jpg" alt="header" />
        </div>
    </div>


    <p id="loginInfo">
        Hello <?php echo htmlentities($_SESSION[ 'username']); ?>!
        <a href="includes/logout.php">Log Out</a>
    <p>



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





    <!-- Letter form -->

    <div class='hidden indForm' id="letterForm">

        <form action="processes/activityProcesses/letterProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
            <tr>
                <td style="width:150px;vertical-align:top">Note</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 125px; width: 400px" name="letter_note"></textarea>
                </td>
            </tr>

        </table>

        <input id="submit" type="submit" value="Submit" />
        </form>

    </div>





    <!-- Review form -->

    <div class='hidden indForm' id="reviewForm">
        <form action="processes/activityProcesses/reviewProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
                <td style="width: 150px">Text</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="review_text"></textarea>
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Note</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="review_note"></textarea>
                </td>
            </tr>
        </table>
    </div>






    <!-- Contest form -->

    <div class='hidden indForm' id="contestForm">
        <form action="processes/activityProcesses/contestProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
                <td style="width: 150px">Association</td>
                <td style="width: 400px">
                    <input type="text" name="contest_assoc" />
                </td>
            </tr>
            <tr>
                <td style="width:150px;vertical-align:top">Notes</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="contest_notes"></textarea>
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>


    <!-- Fan Club form -->

    <div class='hidden indForm' id="clubForm">
        <form action="processes/activityProcesses/fanClubProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
                    <input type="text" name="fan_club_name" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Abbreviation</td>
                <td style="width: 400px">
                    <input type="text" name="fan_club_abbr" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Association</td>
                <td style="width: 400px">
                    <input type="text" name="fan_club_assoc" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px">Notes</td>
                <td style="width: 400px">
                    <textarea type="text" style="height: 50px; width: 400px" name="fan_club_notes"></textarea>
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>



    <!-- Meeting form -->

    <div class='hidden indForm' id="meetingForm">
        <form action="processes/activityProcesses/meetingProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
                    <textarea type="text" style="height: 50px; width: 400px" name="mtg_notes"></textarea>
                </td>
            </tr>
        </table>
        <input id="submit" type="submit" value="Submit" />
        </form>
    </div>


    <!-- Mention form -->

    <div class='hidden indForm' id="mentionForm">
        <form action="processes/activityProcesses/mentionProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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

    <div class='hidden indForm' id="classifiedsForm">
        <form action="processes/activityProcesses/classifiedsProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
    <div class='hidden indForm' id="penPalsForm">
        <form action="processes/activityProcesses/penpalsProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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

    <div class='hidden indForm' id="tracesForm">
        <form action="processes/activityProcesses/tracesProcess.php" method="post" />
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
                        <input type="text" class="autoName" name="selectedPerson" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/personForm.html" class="form" title="Create New Person" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Person</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <!-- put the the overlay below before closing </body> the end of the page -->

        <div class="locationPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Person's location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoLocation" name="selectedLocation" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px"></td>
                    <td>
                        <a href="forms/locationForm.html" class="form" title="Create New Location" data-modal="{ width: 500, closeOnEscape: true }">
                            <button>
                                Create New Location
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sourcePrompt">
            <table>
                <tr>
                    <td>
                        <h3>Source</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Series Title</td>
                    <td style="width: 400px">
                        <input type="text" class="autoSeries" name="selectedSeries" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Issue</td>
                    <td style="width: 400px">
                        <input type="text" class="autoIssue" name="selectedSource" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/sourceForm.html" class="form" title="Create New Source" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Source</button>
                            </a>
                        </td>
                    </tr>

                </tr>

            </table>
        </div>
        <div class="physLocPrompt">
            <table>
                <tr>
                    <td>
                        <h3>Physical Location</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">Location</td>
                    <td style="width: 400px">
                        <input type="text" class="autoPhysLoc" name="selectedPhysLoc" />
                    </td>
                    <tr style="background-color: white">
                        <td style="width: 150px"></td>
                        <td>
                            <a href="forms/physLocForm.html" class="form" title="Create New Physical Location" data-modal="{ width: 500, closeOnEscape: true }">
                                <button>Create New Physical Location</button>
                            </a>
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
                    <input type="text" name="traces_col_title" />
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
    <?php else : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
    </p>
    <?php endif; ?>

</body>

</html>