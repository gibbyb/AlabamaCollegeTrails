

<div class="join-header-section">
    <h2>Join Info</h2>
    <p>Wondering how to join on our next adventure? All you have to do is fill out the information below and we'll get back to you as soon as we can! Think we're taking awhile or have any questions? Find us on the Contact Page!</p>
</div>

<div class="join-header-section">
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <p>Name: <input type="text" name="name" value="<?php echo $username;?>"></p>
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <p>E-mail: <input type="text" name="email" value="<?php echo $email;?>"></p>
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <p>Phone Number: <input type="text" name="website" value="<?php echo $phone;?>"></p>
  <br><br>
  <p>Social Media Info:</p> <p><textarea name="comment" rows="5" cols="40"><?php echo $info;?></textarea></p>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") {
      echo "checked";
  }
  ?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") {
      echo "checked";
  }
  ?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") {
      echo "checked";
  }
  ?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>
