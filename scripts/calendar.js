/* Author: Matthew Morelli */
// Calendar Tutorial: https://www.youtube.com/watch?v=o1yMqPyYeAo&ab_channel=CodeAndCreate

const today = new Date();
// Prevent user from creating events in the past.
var minInput = new Date();
minInput.setHours(0,0,0,0);
document.getElementById("when").min = minInput.toISOString().substring(0,16);

const showCalendar = () => {

  
  var realDay = new Date(); // This is to compare against the dates being shown on the calendar each time
  // the function is loaded

  const m = today.getMonth();
  const day = today.getDay();
  const date = today.getDate();
  const y = today.getFullYear();
  const justyear = today.getFullYear();

  const lastOfPrevMonth = new Date(today.getFullYear(), today.getMonth(), 0);
  const sizeOfLastMonth = lastOfPrevMonth.getDate();

  const firstOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
  const firstDay = firstOfMonth.getDay();

  const lastOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
  const sizeOfMonth = lastOfMonth.getDate();
  const lastDay = lastOfMonth.getDay();

  const datesInMonth = document.querySelector(".monthdaynums");

  const mabbr = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  const ms = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  const ds = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];

  // Calendar header based on current date
  document.querySelector("#date h1").innerHTML = ms[m];
  document.querySelector("#date p").innerHTML = ds[day] + `, ` + mabbr[m] + ` ` + date + ` ` + y;

  document.querySelector("#only-year").innerHTML = justyear;

  var dates = ``;

  for (var i = sizeOfLastMonth - firstDay; i < sizeOfLastMonth; i++) {
    dates += `<a href="#" class="fillerday">${i}</a>`;
  }

  for (var i = 1; i <= sizeOfMonth; i++) {
    // Prevents selecting days before current day.
    if (realDay.getMonth() == today.getMonth() && realDay.getFullYear() == today.getFullYear()) {
      if (i < realDay.getDate()) {
        dates += `<a href="#" class="fillerday">${i}</a>`;
      } else if (i == realDay.getDate()) {
        dates += `<a href="#" id="current" class="border border-primary rounded" role="button" data-bs-toggle="modal" data-bs-target="#eventModal">${i}</a>`;
      } else {
        dates += `<a href="#" role="button" data-bs-toggle="modal" data-bs-target="#eventModal">${i}</a>`;
      }
    } else {
      dates += `<a href="#" role="button" data-bs-toggle="modal" data-bs-target="#eventModal">${i}</a>`;
    }
  }

  for (var i = 1; i < 7 - lastDay; i++) {
    dates += `<a href="#" class="fillerday">${i}</a>`;
  }

  datesInMonth.innerHTML = dates;
};

document.querySelector(".back").addEventListener("click", () => {
  const realDay = new Date();
  // This prevents the user from going back in time on the calendar
  if (!(realDay.getMonth() == today.getMonth() && realDay.getFullYear() == today.getFullYear())) {
    today.setMonth(today.getMonth() - 1);
    showCalendar();
  }
});

document.querySelector(".next").addEventListener("click", () => {
  today.setMonth(today.getMonth() + 1);
  showCalendar();
});

showCalendar();
