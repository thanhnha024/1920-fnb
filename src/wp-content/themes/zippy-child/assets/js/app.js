function initCalendar(updatePrams = Object) {
  let currentDate = new Date();
  currentDate.setDate(currentDate.getDate() + 1);
  let options = {
    date: {
      today: currentDate,
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
  let month = String(currentDate.getMonth() + 1).padStart(2, "0"); // January is 0
  let day = String(currentDate.getDate()).padStart(2, "0");

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
  // $(".date-box").each(function (index, element) {
  $("body").on("click ", ".date-box", function (e) {
    e.preventDefault();
    $(".date-box").removeClass("selected");
    //active class
    $(this).addClass("selected");

    let selected_date = $(this).attr("data-date-short");

    var partsDate = splitDate(selected_date);
    initCalendar(partsDate);
  });
  // });
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
      window.location.href = "/shop/";
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

("use strict");
$ = jQuery;

$(document).ready(function () {
  initCalendar();
  toggleMoreDate();
  chooseDate();
  trigerMainButton();
  validationEvent();
  editStore();
  backStore();
  backOrder();
  selectDinningPreferences();
  saveStoreToSession();
  resetPickupSession();
});
//display_popup_pickup
document.getElementById("pickupButton").addEventListener("click", function () {
  jQuery.ajax({
    url: "/wp-admin/admin-ajax.php",
    type: "POST",
    data: {
      action: "display_popup_pickup",
      pickupstatus: 1,
    },
    success: function (response) {
      var acheckLink = document.getElementById("acheck");
      acheckLink.click();
    },
    error: function (error) {
      console.log("Failed to process items.");
    },
  });
});
//save_store_to_session
jQuery(document).ready(function ($) {
  //Quantity mini cart
  $("body").on("change", ".quantity.buttons_added .qty", function () {
    var $input = $(this);
    var cart_item_key = $input.attr("data-cart-item-key");
    $.ajax({
      type: "POST",
      url: mini_cart_params.ajax_url,
      data: {
        action: "woocommerce_update_cart_item_quantity",
        cart_item_key: cart_item_key,
        quantity: $(this).val(),
        _wpnonce: mini_cart_params.update_cart_nonce,
      },
      success: function (response) {
        $("#cart-items-count").text(
          "You have added " + response.data["cart_count"] + " items"
        );
        // Reload the mini cart
        $(document.body).trigger("wc_fragment_refresh");
      },
      error: function (response) {
        console.log("Error:", response);
      },
    });
  });
});

//Event click view map on pop up
document.addEventListener("DOMContentLoaded", function () {
  var items = document.querySelectorAll(".items-infor-pickup-content");

  items.forEach(function (item) {
    item.addEventListener("click", function () {
      items.forEach(function (el) {
        el.classList.remove("active");
      });

      item.classList.add("active");

      var linkmapElement = item.querySelector(".linkmap");
      if (linkmapElement) {
        var linkmapText =
          linkmapElement.textContent || linkmapElement.innerText;

        var viewmapElement = document.getElementById("viewmap");
        if (viewmapElement) {
          viewmapElement.setAttribute("href", linkmapText);
        }
      }
    });
  });
});

function editStore() {
  $("body").on("click", ".edit-store-btn", function (e) {
    e.preventDefault();
    var editStore = document.getElementById("edit-store");
    editStore.click();
  });
}
function backStore() {
  $("body").on("click", ".btn-back-pickup-store", function (e) {
    e.preventDefault();
    var backStore = document.getElementById("back-store");
    backStore.click();
  });
}
function backOrder() {
  $("body").on("click", ".btn-back-pickup-order", function (e) {
    e.preventDefault();
    var backOrder = document.getElementById("back-pickup-order");
    backOrder.click();
  });
}
function selectDinningPreferences() {
  $("body").on("click", ".btn.select-dinning-preferences", function (e) {
    e.preventDefault();
    var selectDinningPreferences = document.getElementById(
      "select-dinning-preferences"
    );
    selectDinningPreferences.click();
  });
}

function saveStoreToSession() {
  $(".button-selected-store").click(function (e) {
    e.preventDefault();
    var storeId = $(this)
      .closest(".infor-pickup")
      .find(".items-infor-pickup-content.active")
      .data("store-id");
    if (storeId) {
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action: "save_store_to_session",
          store_id: storeId,
        },
        success: function (response) {
          var calendarPickupLink = document.getElementById("calendar-pickup");
          calendarPickupLink.click();

          $("#notification").hide();

          // Render the HTML segment
          if (response.success && response.data.html_segment) {
            $("#pickup-info-container").html(response.data.html_segment);
          }
          if (response.success && response.data.html_select_time) {
            $("#time-select-control").html(response.data.html_select_time);
          }
        },
        error: function (error) {
          console.log("Failed to save store.");
        },
      });
    } else {
      console.error("No active store selected.");
      $("#notification")
        .text("No active store selected. Please select a store.")
        .show();
    }
  });
}
function resetPickupSession() {
  $(".btn-just-browsing").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      method: "POST",
      data: {
        action: "reset_pickup_session",
      },
      success: function (response) {
        window.location.href = "/order";
      },
      error: function () {
        alert("An error occurred. Please try again.");
      },
    });
  });
}
