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

function get_the_next_day($number)
{

  // set the default timezone to use.
  date_default_timezone_set('Asia/Singapore');
  // Get the current date
  $timetemp =  '+' . $number . 'day';
  $currentDate = date('Y-m-d');

  // Calculate the next day using strtotime() function
  $nextDayTimestamp = strtotime($timetemp, strtotime($currentDate));

  $date_time = array();
  // Format the next day's date, month, and day
  $nextDayDate = date('d', $nextDayTimestamp);
  $nextDayMonth = date('F', $nextDayTimestamp);
  $nextDayDay = date('D', $nextDayTimestamp);

  $date_time = array(
    'date' => $nextDayDate,
    'day' => $nextDayDay,
    'month' => $nextDayMonth,

  );
  return $date_time;
}
