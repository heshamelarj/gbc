window.onload = () => {
  if (/(edit|create)$/.test(window.location.pathname))
    manageImageUploadStyling();
};

const manageImageUploadStyling = () => {
  let uploadFile = document.querySelector("#s8feb4ca090_image_file");
  let uploadFileImage = document.querySelector("#employeImageUpload");
  console.log(uploadFile.classList);
  uploadFileImage.addEventListener("click", e => {
    //using Jquery
    uploadFile.click();
  });

  uploadFile.addEventListener("change", event => {
    uploadFileImage.src = URL.createObjectURL(event.target.files[0]);
  });
};
function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}
function getRgbRandomColor(rColor, gColor, bColor) {
  return "rgb(" + rColor + "," + gColor + "," + bColor + ")";
}
function padTime(val) {
  if (val.length < 2) {
    return "0" + val;
  }
  return val;
}
let ConfirmBox = function() {
  this.ok;
  this.cancel;
  this.init();
};
ConfirmBox.prototype = {
  init: function() {
    this.create();
  },
  create: function() {
    if (!document.querySelector("#confirmBox")) {
      let confirmBox = document.createElement("div");
      confirmBox.id = "confirmBox";
      let html = `<div id="innerConfirmBox">
                    <h2 id="confirmHeader">Are you sure you want to change the duraton of this event ?</h2>
                    <div id="confirmButtons">
                      <button id="confirmOk">Ok</button>
                      <button id="confirmCancel">Cancel</button>
                    </div>
                  </div>`;
      confirmBox.innerHTML = html;
      return confirmBox;
    } else return document.querySelector("#confirmBox");
  },
  append: function() {
    let confirmBoxDOM = this.create();
    document.body.appendChild(confirmBoxDOM);
  },
  show: function() {
    let confirmBox = this.create();
    confirmBox.classList.remove("hide");
    confirmBox.classList.add("show");
  },
  hide: function() {
    let confirmBox = this.create();
    confirmBox.classList.remove("show");
    confirmBox.classList.add("hide");
  },
  //TODO: fix the click event firing multiple times
  click: function(info) {
    let self = this;
    self.cancel = document.querySelector("#confirmCancel");
    self.ok = document.querySelector("#confirmOk");
    console.log("click event handler");

    handleButtonClick(
      self,
      function() {
        self.hide();
      },
      info,
    );
  },
};
function handleButtonClick(self, callback, info) {
  self.ok.addEventListener(
    "click",
    function(event) {
      event.preventDefault();
      callback();
      handleButtonOk(info);
    },
    false,
  );
  self.cancel.addEventListener(
    "click",
    function(event) {
      event.preventDefault();
      handleButtonCancel(info);
      callback();
    },
    false,
  );
}
function handleButtonOk(info) {
  console.log("handleButtonOk called ");

  updateEventDuration(info);
}
function handleButtonCancel(info) {
  console.log("handleButtonCancel called ");

  info.revert();
}
function updateEventDuration(info) {
  console.log(info);
  let tacheID = info.prevEvent._def.publicId;
  let tache = {
    id: tacheID,
    end: addTimeToEvent(info),
  };
  postData("/admin/agenda/updateTacheDuration", tache);
}
function addTimeToEvent(info) {
  let { hours, mins, secs } = { ...getRangesDiff(info) };
  let { current, prev } = { ...getCurrentAndPrevEndRanges(info) };
  let newEndDate;
  if (hours !== 0) {
    newEndDate = moment(current).add("hours", hours);
  }
  if (mins !== 0) {
    newEndDate = moment(current).add("minutes", mins);
  }
  if (secs !== 0) {
    newEndDate = moment(current).add("seconds", secs);
  }
  return (newEndDate = newEndDate._d);
}
function getRangesDiff(info) {
  let { current, prev } = { ...getCurrentAndPrevEndRanges(info) };
  console.log(current);
  console.log(prev);
  return ({ h, m, s } = {
    ...rangesDiff(moment.utc(current), moment.utc(prev)),
  });
}
function getCurrentAndPrevEndRanges(info) {
  let current = info.event._instance.range.end.toString().substring(0, 25);
  let prev = info.prevEvent._instance.range.end.toString().substring(0, 25);
  return {
    current: current,
    prev: prev,
  };
}
function rangesDiff(currentRange, prevRange) {
  let current = moment(currentRange, "dddd D MMMM YYYY LT");
  let prev = moment(prevRange, "dddd D MMMM YYYY LT");
  let diff;
  diff = current.diff(prev);
  return millisecondsToHours(diff);
}

const millisecondsToHours = function(diffInMilli) {
  let absDiff;
  let secs;
  let mins;
  let hours;
  if (diffInMilli < 0) {
    absDiff = Math.abs(diffInMilli);
    secs = Math.floor((absDiff / 1000) % 60);
    mins = Math.floor((absDiff / 1000 / 60) % 60);
    hours = Math.floor(absDiff / 1000 / 60 / 60);
  } else {
    secs = Math.floor((diffInMilli / 1000) % 60);
    mins = Math.floor((diffInMilli / 1000 / 60) % 60);
    hours = Math.floor(diffInMilli / 1000 / 60 / 60);
  }

  if (diffInMilli < 0) {
    return {
      hours: hours > 0 ? hours * -1 : hours,
      minutes: mins > 0 ? mins * -1 : mins,
      seconds: secs > 0 ? secs * -1 : secs,
    };
  }
  return {
    hours: hours,
    minutes: mins,
    seconds: secs,
  };
};
