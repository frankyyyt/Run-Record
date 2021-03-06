<?php
	date_default_timezone_set('America/New_York');
    try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $query = "SELECT rrruns.RunID,`Distance`,`Time`,`AddDate`,`Date`,rruser.`UserID`,rruser.Username,`Difficulty`, `Terrain`, `Conditions`, `Temperature`, `Comments`, `TimeOfDay` FROM `rrruns` LEFT JOIN `rruserruns` on rrruns.RunID=rruserruns.RunID LEFT JOIN rruser on rruser.UserID=rruserruns.UserID ORDER BY `Date` DESC, `AddDate` DESC LIMIT 1";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $statement = $pdo->prepare($query);
        $statement->execute();

        // put query results into array
        $a = $statement->fetch(PDO::FETCH_ASSOC);

            $dayOfWeek = date("l",strtotime($a['Date']));
            $month = date("F",strtotime($a['Date']));
            $day = date("j",strtotime($a['Date']));
            $year = date("Y",strtotime($a['Date']));

        $html=""; 
        $html = '
                        <div class="panel panel-primary" id="' . $a['RunID'] .'">
                          <div class="panel-heading">
                            <div class="pull-left">
                              <h3 class="panel-title"><strong>' . $a['Username'].'\'s run on '.$dayOfWeek . ', ' . $month . ' ' . $day . ', ' . $year . '</strong></h3>
                            </div>
                            <div class="pull-right">
                              <h3 class="panel-title"><strong>' . $a['TimeOfDay'] . '</strong></h3>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-6 col-lg-6">
                                <table class="table table-user-information">
                                  <tbody>
                                    <tr>
                                      <td>Distance</td>
                                      <td>' . $a['Distance'] . ' miles</td>
                                    </tr>
                                    <tr>
                                      <td>Time</td>
                                      <td>' . gmdate("H:i:s", $a['Time']) . '</td>
                                    </tr>
                                    <tr>
                                      <td>Pace</td>
                                      <td>' . gmdate("i:s", $a['Time']/$a['Distance']) . '</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="col-md-6 col-lg-6">
                                <table class="table table-user-information">
                                  <tbody>
                                    <tr>
                                      <td>Difficulty</td>
                                      <td>' . $a['Difficulty']. '</td>
                                    </tr>
                                    <tr>
                                      <td>Terrain</td>
                                      <td>' . $a['Terrain'] . '</td>
                                    </tr>
                                    <tr>
                                      <td>Conditions</td>
                                      <td>' . $a['Conditions'] . '</td>
                                    </tr>
                                    <tr>
                                      <td>Temperature</td>
                                      <td>' . $a['Temperature'] . '</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>';

        $ret["ID"]=$a['RunID'];
        $ret['HTML']=$html;
        echo json_encode($ret);
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
?>