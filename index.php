<?php
$uptime = shell_exec("neofetch | grep Uptime | cut -f 2 -d ':' | sed 's/\x1B\[[0-9;]\+[A-Za-z]//g'");
$datetime = date(DATE_RFC822);
$processes = shell_exec('top -b -n 1 | head -n 20');
$ip_address = shell_exec('hostname -I | cut -f 1 -d " "');
$hostname = shell_exec('hostname');
$network = shell_exec('vnstat -i eth0');
$temperature = floatval(shell_exec('vcgencmd measure_temp | cut -f 2 -d "=" | cut -f 1 -d "\'"'));
$filesystem = shell_exec("df -h | grep /dev/sda1 | awk '{print$1}'");
$total_storage = shell_exec("df -h | grep /dev/sda1 | awk '{print$2}'");
$used_storage = shell_exec("df -h | grep /dev/sda1 | awk '{print$3}'");
$available_storage = shell_exec("df -h | grep /dev/sda1 | awk '{print$4}'");
$percentage_storage = shell_exec("df -h | grep /dev/sda1 | awk '{print$5}'");
$storage_mount = shell_exec("df -h | grep /dev/sda1 | awk '{print$6}'");
$qbittorrent = $ip_address.':8080';
$kodi = $ip_address.':2468';

$reboot = $ip_address.'/reboot.php';

if(is_float($temperature)){
  if($temperature < 70.0) {
    $tempColor = 'Green';
  } elseif ($temperature < 80.0) {
    $tempColor = 'Yellow';
  } else {
    $tempColor = 'Red';
  }
} else {
  $tempColor = 'White';
}


?>

<html>
  <head>
    <link rel="icon" type="image/png" href="/RaspberryPi.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/RaspberryPi.png" sizes="32x32">
    <title>
      Raspberry Pi Web Console
    </title>
    <style>
      html {
        color: White;
        background-image: url('/RaspberryPi.png');
        background-color: #141414;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center center;
        font-size: 16px;
        font-family: monospace;
        }
      h1 {
        font-size: 34px;
        }
      h2 {
        font-size: 24px;
        }
      table, th, td {
        border: 1px solid white;
        border-collapse: collapse;
        }
      a:link, a:visited {
        background-color: #54f100;
        color: black;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        }
      a:hover, a:active {
        background-color: green;
        }
      .reboot:link, .reboot:visited {
        background-color: #f44336;
        color: white;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        }
      .reboot:hover, .reboot:active {
        background-color: red;
        }
      .sort {
        border: none;
        padding-right: 25px;
        padding-bottom: 25px;
        text-align: left;
        vertical-align: top;
        }
    </style>
  </head>

  <body>
    <h1>
      <u>Raspberry Pi Web Console</u>
    </h1>

    <table class="sort">
      <tr>
        <td class="sort">
            <h2>
              Raspberry Pi General Information:
            </h2>

            <b>Visited page on: </b><?php echo $datetime;?></br>

            <b>Hostname: </b><?php echo $hostname;?></br>

            <b>IP address: </b><?php echo $ip_address;?></br>

            <b>Uptime: </b><?php echo $uptime;?></br>

            <b>Current system temperature: </b><span style="color:<?php echo $tempColor;?>"><?php echo $temperature;?>'C</span></br></br>
        </td>
      </tr>
    </table>

    <table class="sort">
      <tr>
        <td class="sort">
            <h2>
              Raspberry Pi Storage:
            </h2>

            <table>
              <tr>
                <th>
                  Filesystem
                </th>
                <td>
                  <?php echo $filesystem;?>
                </td>
              </tr>
              <tr>
                <th>
                  Total Storage Space
                </th>
                <td>
                  <?php echo $total_storage;?>
                </td>
              </tr>
              <tr>
                <th>
                  Used Storage Space
                </th>
                <td>
                  <?php echo $used_storage;?>
                </td>
              </tr>
              <tr>
                <th>
                  Available Storage Space
                </th>
                <td>
                  <?php echo $available_storage;?>
                </td>
              </tr>
              <tr>
                <th>
                  Percentage Used
                </th>
                <td>
                  <?php echo $percentage_storage;?>
                </td>
              </tr>
              <tr>
                <th>
                  Mount Location
                </th>
                <td>
                  <?php echo $storage_mount;?>
                </td>
              </tr>
            </table>
        </td>
        <td class="sort">
            <h2>
              Raspberry Pi Running Services:
            </h2>

            <table>
              <tr>
                <th>
                  qBittorrent Web UI
                </th>
                <td>
                  <a href="http://<?php echo $qbittorrent?>" target="_blank">Click Here</a>
                </td>
              </tr>
              <tr>
                <th>
                  Kodi Web UI
                </th>
                <td>
                  <a href="http://<?php echo $kodi?>" target="_blank">Click Here</a>
                </td>
              </tr>
              <tr>
                <th>
                  Web Server
                </th>
                <td>
                  <a href="http://<?php echo $ip_address?>" target="_blank">Click Here</a>
                </td>
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td class="sort">
            <h2>
              Raspberry Pi Network Statistics:
            </h2>

            <table>
              <tr>
                <td>
                  <pre><?php echo $network;?></pre>
                </td>
              </tr>
            </table>
        </td>
        <td class="sort">
            <h2>
              Raspberry Pi Processes:
            </h2>

            <table>
              <tr>
                <td>
                  <pre><?php echo $processes;?></pre>
                </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>

    <h2 style='color: Red'>
      REBOOT RASPBERRY PI:
    </h2>

    <a class="reboot" href="http://<?php echo $reboot?>">REBOOT</a>

  </body>

</html>
