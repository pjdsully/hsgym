<html>
  <head>
    <title>Registration Received</title>
    <link rel="stylesheet" href="hsgym.css"></link>
    <link rel="shortcut icon" href="https://files.ecatholic.com/1053/favicon.ico?t=1743454958000"></link>
  </head>
  <?php
     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
         echo "<body><h1>400: Bad Request</h1></body></html>";
         http_response_code(400);
         exit(400);
         }
     require_once('dbfunctions.php');
     insertFamily();
     $children = $_POST['count'];
     function monthName($rowNum) {
         return date("F", mktime(0, 0, 0, $_POST['dobm_' . $rowNum], 1)); // 'F' formats to full month name
     }
     function gradeName($rowNum) {
         $grade = $_POST['grade_' . $rowNum];
         if ($grade == -1) {
             return "Pre-K";
         }
         if ($grade == 0) {
             return "K";
         }
         return $grade;
     }
     function childRow($rowNum) { ?>
       <tr id="row_<?php echo $rowNum?>">
         <td><span class="formValue"><?php echo $_POST['name_' . $rowNum]?></td>
            <td>
              <span class="formValue"><?php echo monthName($rowNum)?></span>
              <span class="formValue"><?php echo $_POST['doby_' . $rowNum]?></span>
            </td>
            <td>
              <span class="formValue"><?php echo gradeName($rowNum)?></span>
            </td>
          </tr>
          <tr id="row_<?php echo $rowNum?>a">
            <td colspan="3">
            <span class=formValue"><?php echo $_POST['restrictions_' . $rowNum]?></span>
            </td>
          </tr>
    <?php } ?>
  <body>
    <h1>Registration Received</h1>
    <p>A member of the core team will reach out to you shortly.</p>
    <p>If you have any concerns, please just <a href="mailto:hsministrystemarie@gmail.com">drop us an email</a>.</p>
      <h2>Contact Information</h2>
      <div class="contact">
        <label for="pname">Name of Parent(s)/Guardian(s):</label>
        <span class="formValue"><?php echo $_POST['pname']?></span>
        <label for="address">Address:</label>
        <span class="formValue"><?php echo $_POST['address']?></span>
        <label for="city">City, State, Zip:</label>
        <span class="formValue"><?php echo $_POST['city']?></span>
        <label for="telephone">Telephone:</label>
        <span class="formValue"><?php echo $_POST['telephone']?></span>
        <label for="cellphone">Cell phone in case of emergency or urgent notification:</label>
        <span class="formValue"><?php echo $_POST['cellphone']?></span>
        <label for="email">Email:</label>
        <span class="formValue"><?php echo $_POST['email']?></span>
      </div>
      <h2>Participating Children</h2>
      <p>Please provide information about all children who will be participating in gym. For this purpose,
        even children who will be eighteen by the end of the school year should be listed.
        Please do <i>not</i> include infants and toddlers who will not participate in class.
      <div class="numberOfChildren">
        <label for="count">Number of <i>Participating</i> Children:</label>
        <span class="formValue"><?php echo $children ?></span>
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
                for ($i = 1; $i <= $children; ++$i) {
                    childRow($i);
                }
          ?>
        </tbody>
      </table>
      <h2>About Your Family</h2>
      <div class="about">
        <label for="new">New to the gym ministry?</label>
        <span class="formValue"><?php echo $_POST['new'] ? "Yes" : "No"?></span>
        <label for="years">How many years have you participated in this ministry?</label>
        <span class="formValue"><?php echo $_POST['years']?></span>
        <label for="parish">Parish:</label>
        <span class="formValue"><?php echo $_POST['parish']?></span>
        <label for="pcity">City:</label>
        <span class="formValue"><?php echo $_POST['pcity']?></span>
      </div>
  </body>
</html>
