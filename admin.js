$(document).ready(function(){

    

})






var defaultPasscode = "00000000";
const correctPasscode = "DR9090AX"; // The actual passcode should be securely stored on server side



$(document).ready(function () {
  // Listen for passcode input
  $("#passcodeInput").on("input", function () {
    // cc
    let enteredPasscode = $(this).val();

    // Initially hide row
    $("#drow").addClass("d-none");
    $("#courseListUploadForm").addClass("d-none");

    if (enteredPasscode.length === 8) {
      if (enteredPasscode === correctPasscode) {
        // Show row if passcode is correct
        $("#drow").removeClass("d-none");
        $("#courseListUploadForm").removeClass("d-none");
      }
    }
  });
});



