$(document).ready(function () {



    $("#saveChoice,#footerSaveChoice").click(function () {
      const indexNumber = $("#indexNumber").val();

      if(aeEmpty(indexNumber)) {
        showToast("aeToastE", "INDEX NUMBER REQUIRED", "Please enter your index number.", "20");
        return;
      }
  
      $.ajax({
        type: "post",
        cache: false,
        url: "saveOptions.php",
        data: { 
          indexNumber: indexNumber,
          courseData: JSON.stringify(userSelections)
        },
        dataType: "text",
        success: function (data, status) {

           // alert(data)
         
           showToast("aeToastS", "Data Saved Successfully", "All course codes along with their respective options have been successfully saved to the database. You may proceed with other tasks.", "20");

        },
        error: function (xhr, status, error) {
          showToast("aeToastE", "Error", "Failed to save data.", "20");
          console.error(error);
        },
      });
    });

    
  });
  



  function deleteAllCourses() {
    $.ajax({
      type: "post",
      cache: false,
      url: "DELETE_COURSE.php",
      dataType: "json",
      success: function (data, status) {
        showToast("aeToastS", "ALL COURSES DELETED SUCCESSFULLY", "All courses have been successfully deleted from the database.", "20");
      },
      error: function (xhr, status, error) {
        showToast("aeToastE", "Operation Failed", "Failed to delete all courses from the database.", "20");
      },
    });
  }
  
  $('#closeModalButton').on('click', function() {
    showToastY(
      "aeToastY",
      "Confirm Delete All Loaded Courses",
      "Are you sure you want to delete all courses?",
      "20",
      deleteAllCourses,
      function() {
        showToast("aeToastS", "Operation Cancelled", "The delete operation was cancelled.", "20");
      }
    );
  });
  