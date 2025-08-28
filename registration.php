<html>
  <head>
    <title>Registration for Ste. Marie Homeschool Gym</title>
    <link rel="stylesheet" href="hsgym.css"></link>
    <link rel="shortcut icon" href="https://files.ecatholic.com/1053/favicon.ico?t=1743454958000"></link>
    <script rel="script" src="registration.js"></script>
  </head>
  <?php $children = 3; $maxChildren = 12; function childRow($rowNum) { ?>
       <tr id="row_<?php echo $rowNum?>">
         <td><input required type="text" id="name_<?php echo $rowNum?>" name="name_<?php echo $rowNum?>" placeholder="FirstName LastName"/></td>
            <td>
              <select id="dobm_<?php echo $rowNum?>" name="dobm_<?php echo $rowNum?>">
                <option value="" disabled selected hidden>Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select id="doby_<?php echo $rowNum?>" name="doby_<?php echo $rowNum?>">
                <option value="" disabled selected hidden>Year</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
              </select>
            </td>
            <td>
              <select id="grade_<?php echo $rowNum?>" name="grade_<?php echo $rowNum?>">
                <option value="" disabled selected hidden>Grade</option>
                <option value="-1">Pre-K</option>
                <option value="0">K</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </td>
          </tr>
          <tr id="row_<?php echo $rowNum?>a">
            <td colspan="3">
            <textarea type="text" id="restrictions_<?php echo $rowNum?>" name="restrictions_<?php echo $rowNum?>" placeholder="For Child #<?php echo $rowNum?>, please list any physical restrictions, limitations, or medical conditions this child may have which you feel is necessary information for the coaches."></textarea>
            </td>
          </tr>
    <?php } ?>
  <body>
    <h1>Ste. Marie Parish Homeschool Gym Registration</h1>
    <p>Thank you for your interest in our homeschool gym ministry, etc., etc.</p>
    <p>The information on this form will be used only for homeschool gym planning purposes and will be kept confidential.</p>
    <p class="disclaimer">Submission of this information does not guarantee your participation in homeschool gym.</p>
    <form action="reg_received.php" method="post">
      <h2>Contact Information</h2>
      <div class="contact">
        <label for="pname">Name of Parent(s)/Guardian(s):</label>
        <input required type="text" id="pname" name="pname" placeholder="FirstName [and FirstName] LastName"/>
        <label for="address">Address:</label>
        <input required type="text" id="address" name="address"/>
        <label for="city">City, State, Zip:</label>
        <input required type="text" id="city" name="city"/>
        <label for="telephone">Telephone:</label>
        <input required type="text" id="telephone" name="telephone"/>
        <label for="cellphone">Cell phone in case of emergency or urgent notification:</label>
        <input type="text" id="cellphone" name="cellphone"/>
        <label for="email">Email:</label>
        <input required type="email" id="email" name="email"/>
      </div>
      <h2>Participating Children</h2>
      <p>Please provide information about all children who will be participating in gym. For this purpose,
        even children who will be eighteen by the end of the school year should be listed.
        Please do <i>not</i> include infants and toddlers who will not participate in class.
     <div class="numberOfChildren">
        <label for="count">Number of <i>Participating</i> Children:</label>
        <input required type="number" min="1" max="<?php echo $maxChildren ?>" value="<?php echo $children ?>" id="count" name="count"/>
     </div>
      <table>
        <thead>
          <tr>
            <td>Child&apos;s Full Name</td><td>Date of birth</td><td>Grade</td>
          </tr>
        </thead>
        <tbody>
          <?php
                /* Generate table row for children */
                for ($i = 1; $i <= $maxChildren; ++$i) {
                    childRow($i);
                }
          ?>
        </tbody>
      </table>
      <h2>About Your Family</h2>
      <div class="about">
        <label for="new">New to the gym ministry?</label>
        <select required id="new" name="new" value="1">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
        <label for="years">How many years have you participated in this ministry?</label>
        <input required type="number" min="0" max="30" value="0" id="years" name="years"/>
        <label for="parish">Parish:</label>
        <input required type="text" id="parish" name="parish"/>
        <label for="pcity">City:</label>
        <input required type="text" id="pcity" name="pcity"/>
      </div>
     <div class="formFooter">
       <button type="submit">Submit Registration</button>
     </div>
   </form>
  </body>
</html>
