
<h2>Select an activity</h2>

<select id='dropdown'>
    <option> </option>
    <option value="div1">Letter</option>
    <option value="div2">Review</option>
    <option value="div3">Contest</option>
    <option value="div4">Fan Club</option>
    <option value="div5">Meeting</option>
    <option value="div6">Editorial</option>
    <option value="div7">Classified</option>
    <option value="div8">Pen Pals</option>
    <option value="div9">Traces</option>
</select>

<br /><br />




<div class='div' id="div1">


<h3>Select a person</h3>
<!-- TODO write the autofill part here -->
<p>or <button class='newperson'>
Create New Person</button></p>


<div class='div' id="div1a">
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>
</div>


<h3>Select a source</h3>
<!-- TODO write the autofill part here -->
<p>or <button class='newSource'>
Create New Source</button></p>

<div class='div' id="div1b">
<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>
</div>

<!-- TODO: MOVE THIS TO TOP, ONCE FIGURE OUT WHY CLICKING CREATE NEW BUTTON ALSO CLICKS SUBMIT -- ANNOYING -->
<form action="process1.php" method="post" />
<h3>Letter</h3>
<p>Unique title <input type="text" name="letter_title" /></p>
<p>Salutation <input type="text" name="salutation" /></p>
<p>Closing <input type="text" name="closing" /></p>
<p>Text <input type="text" name="letter_text" /></p>
<p>Letter page title <input type="text" name="letter_pg_title" /></p>

<input type="submit" value="Submit" />
</form>
</div>





<div class='div' id="div2">
<form action="process2.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Review</h3>
<p>Title <input type="text" name="review_title" /></p>
<p>Text <input type="text" name="review_text" /></p>
<input type="submit" value="Submit" />
</form>
</div>


<div class='div' id="div3">
<form action="process3.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>
<h3>Contests</h3>
<p>Name <input type="text" name="contest_name" /></p>
<p>Description <input type="text" name="contest_desc" /></p>
<p>Affiliation <input type="text" name="contest_aff" /></p>
<input type="submit" value="Submit" />
</form>
</div>




<div class='div' id="div4">
<form action="process4.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Fan Club</h3>
<p>Name <input type="text" name="club_name" /></p>
<p>Abbreviation <input type="text" name="club_abbr" /></p>
<p>Affiliation <input type="text" name="club_aff" /></p>
<input type="submit" value="Submit" />
</form>
</div>



<div class='div' id="div5">
<form action="process5.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Meeting</h3>
<p>Name <input type="text" name="mtg_name" /></p>
<input type="submit" value="Submit" />
</form>
</div>




<div class='div' id="div6">
<form action="process6.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Editorial</h3>
<input type="submit" value="Submit" />
</form>
</div>




<div class='div' id="div7">
<form action="process7.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Classified</h3>
<p>Page title <input type="text" name="classified_title" /></p>
<p>Information <input type="text" name="classified_info" /></p>
<input type="submit" value="Submit" />
</form>
</div>


<div class='div' id="div8">
<form action="process8.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Pen Pals</h3>
<p>Column title <input type="text" name="penpals_title" /></p>
<p>Description <input type="text" name="penpals_desc" /></p>
<input type="submit" value="Submit" />
</form>
</div>



<div class='div' id="div9">
<form action="process9.php" method="post" />
<h3>Person information</h3>
<p>Surname <input type="text" name="surname" /></p>
<p>Forename <input type="text" name="forename" /></p>
<p>Title <input type="text" name="pers_title" /></p>
<p>Role <input type="text" name="role" /></p>
<p>Alternate name <input type="alt_name" name="input1" /></p>
<p>Birth year <input type="text" name="birth_year" /></p>
<p>Birth year source <input type="text" name="byear_source" /></p>
<p>Grade <input type="text" name="grade" /></p>
<p>Race <input type="text" name="race" /></p>
<p>Ethnicity <input type="text" name="ethnicity" /></p>
<p>Sex <input type="text" name="sex" /></p>
<p>Gender <input type="text" name="gender" /></p>
<p>Occupation <input type="text" name="occupation" /></p>
<p>Occupation Source <input type="text" name="occu_source" /></p>

<h3>Location information</h3>
<p>Street <input type="text" name="street" /></p>
<p>City <input type="text" name="city" /></p>
<p>State <input type="text" name="state" /></p>
<p>Country <input type="text" name="country" /></p>
<p>Zipcode <input type="text" name="zipcode" /></p>

<h3>Source</h3>
<p>Source name <input type="text" name="source_name" /></p>
<p>GCD Link (or however this will work) <input type="text" name="gcd_link" /></p>
<p>Date <input type="text" name="date" /></p>
<p>Issue Number <input type="text" name="issue_num" /></p>
<p>Series Name <input type="text" name="series_name" /></p>

<h3>Traces</h3>
<p>Column title <input type="text" name="traces_column_title" /></p>
<p>Description <input type="text" name="traces_desc" /></p>
<input type="submit" value="Submit" />
</form>
</div>







<style type="text/css">
    .div { display: none; }
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#dropdown").change(function() {
            $(".div").hide();
            $("#" + $(this).val()).show();
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
    var $b = $('button.newperson');
    var $p = $('#div1a');

    $b.click(function() {
        var i = $b.index(this);
        $p.hide().eq(i).show()
    })
});
</script>



<script type="text/javascript">
    $(document).ready(function() {
    var $b = $('button.newSource');
    var $p = $('#div1b');

    $b.click(function() {
        var i = $b.index(this);
        $p.hide().eq(i).show()
    })
});
</script>
