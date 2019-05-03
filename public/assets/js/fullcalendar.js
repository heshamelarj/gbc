document.addEventListener("DOMContentLoaded", function() {
  var calendarEl = document.getElementById("calendar");
  var calendar;
  let box = new ConfirmBox();

  fetchData("/admin/agenda/fetchOneDayTachesJson").then(data => {
    let colors = [];
    let dataWithColors = data.map(item => {
      item.color = getRgbRandomColor(
        getRandomInt(255),
        getRandomInt(255),
        getRandomInt(255),
      );
      console.log(item);
      return item;
    });
    calendar = new FullCalendar.Calendar(calendarEl, {
      height: 500,
      weekends: false,
      plugins: ["interaction", "dayGrid", "timeGrid"],
      defaultView: "timeGridWeek",
      editable: true,
      eventResizableFromStart: true,
      timeZone: "Europe/Paris",
      header: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek",
      },
      bootstrapFontAwesome: {
        close: "fa-times",
        prev: "fa-chevron-left",
        next: "fa-chevron-right",
        prevYear: "fa-angle-double-left",
        nextYear: "fa-angle-double-right",
      },
      events: dataWithColors,
      eventDrop: info => {
        toBeUpdatedTacheData = {
          id: info.event.id,
          start: info.event._instance.range.start,
          end: info.event._instance.range.end,
        };
        axios.post("/admin/agenda/editTacheOnAgenda", toBeUpdatedTacheData);
      },
      eventResizeStart: info => {},
      eventResizeStop: info => {
        box.append();
        box.show();
        box.actions();
      },
      eventResize: function(info) {
        console.log(box.whichAction);
      },
    });
    calendar.render();
  });
});
