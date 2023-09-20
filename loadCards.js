
$(document).ready(function() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
});



function generateCards() {
    $.ajax({
      type: "post",
      cache: false,
      url: "loadCards.php",
      dataType: "json",
      success: function (data, status) {
        let cardsHTML = '';
        $.each(data, function(index, course) {
          cardsHTML += `
            <div class="issueCard" id="issueCard-${course.id}">
              <div class="card courseIssueCard m-1">
                <div class="card issueHeaderCard">
                  <span class="close-icon" id="clearSelection-${course.id}" data-toggle="tooltip" title="Click to clear selection"><i class="fa fa-trash" aria-hidden="true"></i></span>
                  <h5 class="card-title">
                    <span id="courseCode-${course.id}">${course.course_code}</span>
                    <span id="courseTitle-${course.id}">${course.title}</span>
                    <span id="courseSemYear-${course.id}">semester: ${course.semester} year: ${course.year}</span>
                  </h5>
                </div>
                <div class="card issueOptionsCard" id="issueSection-${course.id}">
                  <div class="card issueICCard">
                    <label>
                      <input type="radio" name="studentIssue-${course.id}" id="studentIC-${course.id}" value="IC"> 
                      IC
                    </label>
                  </div>
                  <div class="card issueNotInPortalCard">
                    <label>
                      <input type="radio" name="studentIssue-${course.id}" id="studentNotInPortal-${course.id}" value="NOT IN PORTAL"> 
                      NOT IN PORTAL
                    </label>
                  </div>
                  <div class="card issueOtherCard">
                    <label>
                      <input type="radio" name="studentIssue-${course.id}" id="studentOther-${course.id}" value="OTHER"> 
                      OTHER
                    </label>
                  </div>
                  <div class="card issueOtherTextareaCard" id="studentOtherTextarea-${course.id}" style="display: none;">
                    <textarea class="form-control" name="studentOther-${course.id}" id="studentOtherTextarea-${course.id}" placeholder="Specify Issue"></textarea>
                  </div>
                </div>
              </div>
            </div>`;
        });
        $('#studentCardContainer').html(cardsHTML);
      },
      error: function (xhr, status, error) {
        showToast("aeToastE", "Error", "Failed to load course cards.", "20");
      },
    });
  }
  

  





  // Initialize an empty object to store user selections
let userSelections = {};

// Load cards first
generateCards();

// Handle radio button changes for issue selection
$(document).on("change", 'input[type="radio"]', function () {
  const radioId = $(this).attr("id");
  const courseId = radioId.split("-")[1];
  const courseCode = $("#courseCode-" + courseId).text();
  const selectedOption = $(this).val();
  
  // Update userSelections object
  userSelections[courseCode] = selectedOption;

  // Show success toast
  //showToast("aeToastS", "Selection Made", `Option selected for ${courseCode}.`, "20");
});
// Existing code for radio button changes
$(document).on("change", 'input[type="radio"]', function () {
  const radioId = $(this).attr("id");
  const courseId = radioId.split("-")[1];
  const courseCode = $("#courseCode-" + courseId).text();
  const selectedOption = $(this).val();

  // Update userSelections object
  userSelections[courseCode] = selectedOption;

  // Show/Hide textarea for 'OTHER' option
  if (selectedOption === 'OTHER') {
    $(`#studentOtherTextarea-${courseId}`).show();
  } else {
    $(`#studentOtherTextarea-${courseId}`).hide();
  }

  // Show success toast
  //showToast("aeToastS", "Selection Made", `Option selected for ${courseCode}.`, "20");
});

// Listen for textarea changes and update the 'OTHER' value in userSelections
$(document).on("focusout", 'textarea', function () {
  const textareaId = $(this).attr("id");
  const courseId = textareaId.split("-")[1];
  const courseCode = $("#courseCode-" + courseId).text();
  const textAreaValue = $(this).val();

  // Update value for 'OTHER' in userSelections
  if (userSelections[courseCode] === 'OTHER') {
    userSelections[courseCode] = `OTHER: ${textAreaValue}`;
  }
});

$(document).on("click", '.close-icon', function () {
  const iconId = $(this).attr("id");
  const courseId = iconId.split("-")[1];
  const courseCode = $("#courseCode-" + courseId).text();

  // Clear the radio button selection for this course ID
  $(`input[name="studentIssue-${courseId}"]:checked`).prop('checked', false);
  
  // Hide the textarea if it's showing
  $(`#studentOtherTextarea-${courseId}`).hide();

  // Remove this course from userSelections object
  delete userSelections[courseCode];
  
  // Show toast for cleared selection
  //showToast("aeToastS", "Selection Cleared", `Cleared selection for ${courseCode}.`, "20");
});







// Function to get current selections (for debug or later use)
function getCurrentSelections() {
  console.log(userSelections);
}
