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
  this.whichAction;
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
    //confirmBox.classList.toggle("toggle-on");
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
  actions: function() {
    let self = this;
    let actionTaken;
    self.cancel = document.querySelector("#confirmCancel");
    self.ok = document.querySelector("#confirmOk");
    self.ok.addEventListener("click", clickEventFired);
    function clickEventFired() {
      self.hide();
      self.whichAction = "ok";
    }
    self.cancel.addEventListener("click", function() {
      self.hide();
      self.whichAction = "cancel";
    });
  },
};
