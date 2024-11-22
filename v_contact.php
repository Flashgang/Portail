<?php
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Contact</h1>
        <h2>En cas de réclamation ou de suggestion</h2>
    </div>

    <div class="content cadre">
        <p><center>
            <form name='fm_contact' action='index.php?page=contact_send' method='POST'>
                <?php
                    if (isset($_SESSION['role']))
                        echo "Adresse mail &nbsp&nbsp <input type='email' name='mail' size='40' value='".$_SESSION['mail']."' readonly='true' required/><br/><br/>";
                    else
                        echo "Adresse mail &nbsp&nbsp <input type='email' name='mail' size='40' placeholder='Pour vous recontacter' required/><br/><br/>";
                    ?>
                  Message<br/> <textarea style = "resize: none;" rows = "10" cols = "90" name = "description" required></textarea><br/>
                  <input type="submit" value="Envoyer" class="button-secondary pure-button"/>
            </form>
          </center></p>
    </div>
<?php include "v_bottom.php"; ?>
