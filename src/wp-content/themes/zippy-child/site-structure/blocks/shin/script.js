function initCalendar(updatePrams = Object) {
  let options = {
    settings: {
      range: {
        min: getCurrenDate(),
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

async function getCurrenDate() {
  let Date_current = new Date();
  let year = Date_current.getFullYear();
  let month = ("0" + (Date_current.getMonth() + 1)).slice(-2);
  let day = ("0" + Date_current.getDate()).slice(-2);

  // Construct the date string in yyyy-mm-dd format
  let currentDate = `${year}-${month}-${day}`;

  return currentDate;
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
    let selected_date = $(this).attr("data-date");
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

      let selected_date = $(this).attr("data-date");

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
