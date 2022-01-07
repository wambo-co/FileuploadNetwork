<?php
$entries = $db->query("SELECT `Username` FROM `Accounts` ORDER BY RAND() LIMIT 5;");
$clickTest = "No button has been clicked";
if (isset($_POST["showAllSort"])) {
    $entries = $db->query("SELECT `Username` FROM `Accounts` ORDER BY RAND();");
    $clickTest = "Show all button has been clicked";

} elseif (isset($_POST["alphabetSort"])) {
    $entries = $db->query("SELECT `Username` FROM `Accounts` ORDER BY ASC;");
    $clickTest = "Sort by Alphabet has been clicked";
}

echo $clickTest;

while ($row = $entries->fetch_assoc()){
?>

<h3> Other players </h3>
<button name="showAllSort" type="button"> Show All</button>
<button name="alphabetSort" type="button"> Sort by Alphabet</button>
<button name="friendsSort" type="button"> Sort by most friends</button>
<div>
    <p>

    <div style="padding-bottom: 0.5em">
        <p style="display: inline; margin-right: 3em"> <?php echo $row['Username']; ?> </p>
        <button name="friends" type="button"> Add Friend </button>
        <br>
    </div>
    <?php
    }
    ?>
</div>