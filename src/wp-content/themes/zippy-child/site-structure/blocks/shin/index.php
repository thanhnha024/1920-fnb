<div class="infor-pickup">
  <div class="infor-pickup-title">
    <p>Pickup</p>
  </div>
  <div class="infor-pickup-content">
    <h3>Select a Pickup Store</h3>
    <div class="row-infor-pickup">
      <p>1 Store(s) Available</p>
      <p><a href="#">View on Map</a></p>
    </div>
    <div class="items-infor-pickup-content">
      <div class="row-items-infor">
        <svg width="18px" height="18px" viewBox="0 0 24 24" xmlns:xlink="http://www.w3.org/1999/xlink">
          <path d="M0 0h24v24H0z" fill="none"></path>
          <path fill="#5f3327" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
        </svg>
        <p>Queic by Olivia</p>
      </div>
      <div class="row-items-infor">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 15" width="18px" height="18px">
          <path fill="#5f3327" d="M15.3 0H0.9V1.8H15.3V0ZM16.2 9V7.2L15.3 2.7H0.9L0 7.2V9H0.9V14.4H9.9V9H13.5V14.4H15.3V9H16.2ZM8.1 12.6H2.7V9H8.1V12.6Z"></path>
        </svg>
        <p>41 Kreta Ayer Road, Singapore, 089003</p>
      </div>
      <div class="time-infor-items">
        <h4>Earliest Collection Time</h4>
        <p>Tomorrow, 28 Jun 2024 (11:30 AM - 12:30 PM)</p>
      </div>
    </div>
  </div>
  <div class="infor-pickup-content">

    <div class="wrapper">
      <h3>Select a Pickup Date</h3>

      <button lass="wrapper-icon">
        <div class="wrapper-icon">

          <svg height="18px" width="18px">
            <title>Calendar</title>
            <path fill="#ffb25b" fill-rule="evenodd" d="M16.433 17.102a.332.332 0 0 1-.331.331H1.877a.332.332 0 0 1-.331-.331V8.667h14.887v8.435zM14.343 3.55h1.759a1.88 1.88 0 0 1 1.877 1.877v11.674a1.88 1.88 0 0 1-1.877 1.877H1.877A1.88 1.88 0 0 1 0 17.102V5.428A1.88 1.88 0 0 1 1.877 3.55h2.724V1.925c0-.098-.007-.174-.016-.23a.625.625 0 0 0-.195.146A.772.772 0 1 1 3.22.83c.383-.444.949-.72 1.476-.72.172 0 .337.029.492.086.358.133.96.535.96 1.728v3.734a.774.774 0 0 1-1.547 0v-.562H1.877a.332.332 0 0 0-.331.33V7.12h14.887V5.428a.332.332 0 0 0-.331-.331h-1.76V3.55zm-2.185 12.688h2.03a.846.846 0 0 0 .846-.846v-2.03a.846.846 0 0 0-.846-.847h-2.03a.846.846 0 0 0-.846.846v2.03c0 .468.379.847.846.847zm-.326-10.58v-.562h-4.72V3.55h4.72V1.925a1.43 1.43 0 0 0-.017-.23.624.624 0 0 0-.194.146A.772.772 0 1 1 10.45.83c.383-.445.95-.72 1.477-.72.171 0 .337.029.491.086.359.133.96.535.96 1.728v3.734a.774.774 0 0 1-1.546 0z"></path>

          </svg>

          <span class="more-date">More Dates</span>
        </div>
      </button>

    </div>
    <div class="wrapper">
      <div class="wrapper-calendar">
        <div id="calendar"></div>
      </div>
    </div>
    <div class="wrapper">
      <div class="wrapper-date-box">
        <?php $i = 0; ?>

        <?php while ($i < 5) : ?>
          <?php $date_time = get_the_next_day($i); ?>

          <div class="date-box">
            <span class="day"><?php echo ($date_time['day']); ?></span>
            <div class="wrapper-date">
              <span class="date"><?php echo ($date_time['date']); ?></span>
              <span class="month"><?php echo ($date_time['month']); ?></span>
            </div>
          </div>
          <?php $i++; ?>

        <?php endwhile; ?>
      </div>

    </div>
  </div>
  <div class="action-pickup">
    <button>Continue with Selection</button>
  </div>
</div>
