<?php
add_shortcode('pickup_date_calander', 'pickup_date_calander_callback');
function pickup_date_calander_callback()
{
?>
  <div class="infor-pickup-content">

    <div class="wrapper">
      <h3 class="fs-14px fw-600 text-secondary">Select a Pickup Date</h3>

      <button id="calendar-control-button" lass="wrapper-icon">
        <div class="wrapper-icon">

          <svg height="18px" width="18px">
            <title>Calendar</title>
            <path fill="#ffb25b" fill-rule="evenodd" d="M16.433 17.102a.332.332 0 0 1-.331.331H1.877a.332.332 0 0 1-.331-.331V8.667h14.887v8.435zM14.343 3.55h1.759a1.88 1.88 0 0 1 1.877 1.877v11.674a1.88 1.88 0 0 1-1.877 1.877H1.877A1.88 1.88 0 0 1 0 17.102V5.428A1.88 1.88 0 0 1 1.877 3.55h2.724V1.925c0-.098-.007-.174-.016-.23a.625.625 0 0 0-.195.146A.772.772 0 1 1 3.22.83c.383-.444.949-.72 1.476-.72.172 0 .337.029.492.086.358.133.96.535.96 1.728v3.734a.774.774 0 0 1-1.547 0v-.562H1.877a.332.332 0 0 0-.331.33V7.12h14.887V5.428a.332.332 0 0 0-.331-.331h-1.76V3.55zm-2.185 12.688h2.03a.846.846 0 0 0 .846-.846v-2.03a.846.846 0 0 0-.846-.847h-2.03a.846.846 0 0 0-.846.846v2.03c0 .468.379.847.846.847zm-.326-10.58v-.562h-4.72V3.55h4.72V1.925a1.43 1.43 0 0 0-.017-.23.624.624 0 0 0-.194.146A.772.772 0 1 1 10.45.83c.383-.445.95-.72 1.477-.72.171 0 .337.029.491.086.359.133.96.535.96 1.728v3.734a.774.774 0 0 1-1.546 0z"></path>

          </svg>

          <span class="more-date fs-14px ">More Dates</span>
        </div>
      </button>

    </div>
    <div class="wrapper">
      <div id="calendar-control" class="wrapper-calendar" style="display: none;">
        <div id="calendar"></div>
      </div>
    </div>
    <div class="wrapper">
      <div id="calendar-control-week" class="wrapper-date-box">
        <?php $i = 1; ?>

        <?php while ($i < 6) : ?>
          <?php $date_time = get_the_next_day($i); ?>

          <button class="date-box <?php if ($i == 1) echo 'selected'; ?>" data-date="<?php echo ($date_time['fomated_date']); ?>">
            <span class="day"><?php echo ($date_time['day']); ?></span>
            <div class="wrapper-date">
              <span class="date"><?php echo ($date_time['date']); ?></span>
              <span class="month"><?php echo ($date_time['month']); ?></span>
            </div>
          </button>
          <?php $i++; ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php
}

add_shortcode('pickup_time_calander', 'pickup_time_calander_callback');
function pickup_time_calander_callback()
{ ?>
  <div class="infor-pickup-content">

    <div class="wrapper pickup-time">
      <h3>Select a Pickup Time</h3>
      <div class="time-select-control">
        <!-- <select id="time-select-option" class="time-select">
          <option value="0">Please select a timeslot</option>
          <?php
          $step = 0;
          $time_diff =  get_diff_time('6:30 PM');
          ?>
          <?php while ($step  < $time_diff) : ?>
            <?php $time_avaliable =  get_the_timetemp($step); ?>
            <option value="<?php echo $time_avaliable[0] ?> to <?php echo $time_avaliable[1]; ?>">
              <?php echo $time_avaliable[0] ?> to <?php echo $time_avaliable[1]; ?>
            </option>

            <?php $step++; ?>
          <?php endwhile; ?>

        </select> -->
        <select id="time-select-option" class="time-select">
          <option value="">Please select a timeslot</option>
          <option value="11:30 AM to 12:30 PM">11:30 AM to 12:30 PM</option>
          <option value="12:30 PM to 01:30 PM">12:30 PM to 01:30 PM</option>
          <option value="01:30 PM to 02:30 PM">01:30 PM to 02:30 PM</option>
          <option value="02:30 PM to 03:30 PM">02:30 PM to 03:30 PM</option>
          <option value="03:30 PM to 04:30 PM">03:30 PM to 04:30 PM</option>
          <option value="04:30 PM to 05:30 PM">04:30 PM to 05:30 PM</option>
          <option value="05:30 PM to 06:30 PM">05:30 PM to 06:30 PM</option>
        </select>
        <div class="arrow-icon">
          <svg direction="down" width="18px" height="18px" class="sc-1mf0nfy-0 eXyZFy" viewBox="0 0 13 22" xmlns:xlink="http://www.w3.org/1999/xlink">
            <title>Arrow down</title>
            <g fill="none" fill-rule="evenodd" transform="translate(-19 -14)">
              <g transform="translate(14 14)">
                <rect width="22" height="22" rx="2"></rect>
                <path d="M6.78753043,22 C6.32280464,22 5.85927045,21.8200677 5.50893869,21.4613947 C4.81899963,20.7547732 4.83210728,19.6227488 5.53872881,18.9340014 L13.6249577,11.0408125 L5.63524878,3.05110359 C4.93696848,2.35282329 4.93696848,1.22079892 5.63524878,0.523710223 C6.33352908,-0.174570074 7.46436185,-0.174570074 8.16264215,0.523710223 L17.4321344,9.79201083 C17.7693585,10.1292349 17.957632,10.5880027 17.9552488,11.0670278 C17.951674,11.5448612 17.758634,12.0012458 17.4166435,12.3348951 L8.03633206,21.4911848 C7.68838351,21.8307921 7.23795697,22 6.78753043,22" fill="#515151"></path>
              </g>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </div>
<?php
}
