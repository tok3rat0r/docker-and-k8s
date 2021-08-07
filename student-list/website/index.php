
<html>
    <head>
        <title>POZOS</title>
    </head>

    <body>
        <h1>Student Checking App</h1>
        <ul>
            <form action="" method="POST">
            <!--<label>Enter student name:</label><br />
            <input type="text" name="" placeholder="Student Name" required/>
            <br /><br />-->
            <button type="submit" name="submit">List Student</button>
            </form>

            <?php
            function curl_get_contents($url,$username,$password) {
                $curlHandle = curl_init();
                curl_setopt( $curlHandle , CURLOPT_URL, $url );
                curl_setopt( $curlHandle , CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $curlHandle , CURLOPT_USERPWD, "$username:$password" );
                $result = curl_exec( $curlHandle );
                curl_close( $curlHandle );
                return $result;
            }
              if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit']))
              {
              $username = getenv('USERNAME');
              $password = getenv('PASSWORD');
              if ( empty($username) ) $username = 'fake_username';
              if ( empty($password) ) $password = 'fake_password';
              $context = stream_context_create(array(
                "http" => array(
                "header" => "Authorization: Basic " . base64_encode("$username:$password"),
              )));
              $url = 'pozos-api:5000/pozos/api/v1.0/get_student_ages';
              $return_val = curl_get_contents($url, $username, $password);
              if ($return_val === false) {
                echo "<p style='color:red;; font-size: 20px;'>Unable to get student ages from API</p>";
              }
              else {
                $list = json_decode($return_val, true);
                echo "<p style='color:red;; font-size: 20px;'>This is the list of the student with age</p>";
                foreach($list["student_ages"] as $key => $value) {
                    echo "- $key are $value years old <br>";
                }
              }
             }
            ?>
        </ul>
    </body>
</html>
