<?php
function slugify($string)
{
  // Convert the string to lowercase
  $string = strtolower($string);

  // Replace spaces and special characters with dashes
  $string = preg_replace('/[^a-z0-9]+/', '_', $string);

  // Remove leading and trailing dashes
  $string = trim($string, '_');

  return $string;
}

function pr($data)
{
  echo '<style>
  #debug_wrapper {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 999;
    background: #fff;
    color: #000;
    overflow: auto;
    width: 100%;
    height: 100%;
  }</style>';
  echo '<div id="debug_wrapper"><pre>';

  print_r($data); // or var_dump($data);
  echo "</pre></div>";
  die;
}

function get_the_next_day($number, $currentDatePrams = '')
{

  // set the default timezone to use.
  date_default_timezone_set('Asia/Singapore');
  // Get the current date
  $currentDate = $currentDatePrams ? $currentDatePrams : date('Y-m-d');
  $timetemp =  '+' . $number . 'day';

  // Calculate the next day using strtotime() function
  $nextDayTimestamp = strtotime($timetemp, strtotime($currentDate));
  $datetime = new DateTime('tomorrow');
  $tomorow = strtotime($datetime->format('Y-m-d'));
  $fomatedDate = date('D, j M Y', $nextDayTimestamp);
  if($nextDayTimestamp == $tomorow){
    $fomatedDate = 'Tomorow,' .date(' j M Y', $nextDayTimestamp);
  }
  $date_time = array();
  // Format the next day's date, month, and day
  $nextDayDate = date('d', $nextDayTimestamp);
  $nextDayMonth = date('F', $nextDayTimestamp);
  $nextDayDay = date('D', $nextDayTimestamp);
  $shortDate = date('Y-m-d', $nextDayTimestamp);

  $date_time = array(
    'date' => $nextDayDate,
    'day' => $nextDayDay,
    'month' => $nextDayMonth,
    'fomated_date' => $fomatedDate,
    'short_date' => $shortDate

  );
  return $date_time;
}


function select_store($check_store_id)
{
  global $wpdb;
  $store = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT name_store, location_store , start_time , end_time FROM fcs_data_store_available WHERE id = %d",
      $check_store_id
    )
  );
  return $store;
}


function get_the_timetemp($timebonus)
{

  $currentDateTime =  date('Y-m-d h A');

  for ($i = 0; $i < 2; $i++) {
    $timetemp =   $timebonus == 0 && $i == 0 ? 'now' : '+' . $timebonus + $i . ' hour' ; //+1 hour 
    $nextTimestamp = strtotime($timetemp, strtotime($currentDateTime));
    $fomatedTimestamp[$i] = date('H:i A', $nextTimestamp);
  }


  return $fomatedTimestamp;
}

function get_diff_time($time_end, $start_time = ''): int
{
  $startTime = new DateTime('h A');
  // var_dump($startTime);
  if($start_time){
    $startTime = new DateTime( $start_time);
  }
  

  $endTime = new DateTime($time_end);
  $interval = $startTime->diff($endTime);
  $diff_time = $interval->format('%h');
  return  $diff_time;
}
