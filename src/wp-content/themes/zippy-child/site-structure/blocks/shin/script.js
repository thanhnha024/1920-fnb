function initCalendar(updatePrams = Object) {
  let currentDate = new Date();
  currentDate.setDate(currentDate.getDate() + 1);
  let options = {
    date: {
      today:  currentDate,
    },
    settings: {
      range: {
        min: getCurrentDate(),
      },
      selected: {
        dates: [updatePrams.all],
        month: updatePrams.month - 1,
        year: updatePrams.year,
      },
    },
    actions: {
      clickDay(event, self) {
        let selectedDay = self.selectedDates ? self.selectedDates[0] : 0;
        renderBoxDate(selectedDay);
      },
    },
  };
  const calendar = new VanillaCalendar("#calendar", options);
  calendar.init();
}

function getCurrentDate() {
  let currentDate = new Date();
  currentDate.setDate(currentDate.getDate() + 1); // Get tomorrow's date

  // Format the date in yyyy-mm-dd format
  let year = currentDate.getFullYear();
  let month = String(currentDate.getMonth() + 1).padStart(2, '0'); // January is 0
  let day = String(currentDate.getDate()).padStart(2, '0');

  return `${year}-${month}-${day}`;
}

function toggleMoreDate() {
  $("#calendar-control-button").click(function (e) {
    e.preventDefault();
    const text = "Less Dates";
    $(this).find(".more-date").text(text);
    $("#calendar-control").toggle();
    $("#calendar-control-week").toggle();
  });
}

function activeBoxDate(time) {
  $(".date-box").each(function (index, element) {
    let selected_date = $(this).attr("data-date-short");
    $(".date-box").removeClass("selected");

    if (time == selected_date) {
      $(this).addClass("selected");
      return false;
    }
  });
}

function renderBoxDate(time) {
  jQuery.ajax({
    url: "/wp-admin/admin-ajax.php",
    type: "POST",
    data: {
      action: "render_date",
      selected_date_render: time,
    },
    success: function (response) {
      $("#calendar-control-week").html(response);

      activeBoxDate(time);
    },
    error: function (error) {
      console.log("Failed to process items.");
    },
  });
}
function chooseDate() {
  $(".date-box").each(function (index, element) {
    $(this).click(function (e) {
      e.preventDefault();
      $(".date-box").removeClass("selected");
      //active class
      $(this).addClass("selected");

      let selected_date = $(this).attr("data-date-short");

      var partsDate = splitDate(selected_date);
      initCalendar(partsDate);
    });
  });
}

function validationEvent() {
  $("#time-select-option").change(function (e) {
    e.preventDefault();

    $(".time-select-control").removeClass("validation");
    $(".wrapper.pickup-time p").remove();
  });
}
function ajaxAddDate(date, time) {
  if (date == 0 || time == 0) return;
  jQuery.ajax({
    url: "/wp-admin/admin-ajax.php",
    type: "POST",
    data: {
      action: "add_session_date",
      selected_date: date,
      selected_time: time,
    },
    success: function (response) {
      console.log(response);
       window.location.href = '/shop/';
    },
    error: function (error) {
      console.log("Failed to process items.");
    },
  });
}

function splitDate(time) {
  if (!time) return;

  // # Split the string by "-"
  let parts = time.split("-");

  let year = parseInt(parts[0]);
  let month = parseInt(parts[1]);
  let day = parseInt(parts[2]);

  let split_date = {
    all: time,
    year: year,
    month: month,
    day: day,
  };

  return split_date;
}

function trigerMainButton() {
  $("#pickup-date_time").click(function (e) {
    e.preventDefault();
    const date = $(".date-box.selected").attr("data-date");
    const time = $("#time-select-option option:selected").val();
    if (time == "") {
      $(".time-select-control").addClass("validation");
      $(".wrapper.pickup-time").append(
        "<p class='validation'>Please select a time slot</p>"
      );
    } else {
      ajaxAddDate(date, time);
    }
  });
}
