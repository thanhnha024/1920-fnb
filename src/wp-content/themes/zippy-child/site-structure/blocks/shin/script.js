function shin_test() {
  const options = {
    settings: {
      range: {
        min: getCurrenDate(),
      },
    },
    actions: {
      clickDay(event, self) {
        console.log(self.selectedDates);
      },
    },
  };

  const calendar = new VanillaCalendar("#calendar", options);
  calendar.init();
}
function getCurrenDate() {
  let Date_current = new Date();
  let year = Date_current.getFullYear();
  let month = ("0" + (Date_current.getMonth() + 1)).slice(-2);
  let day = ("0" + Date_current.getDate()).slice(-2);

  // Construct the date string in yyyy-mm-dd format
  let currentDate = `${year}-${month}-${day}`;

  return currentDate;
}
