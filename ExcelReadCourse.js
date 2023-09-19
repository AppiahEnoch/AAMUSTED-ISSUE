

 
        $(document).ready(function() {
            $("#courseListFileInput").change(function() {
              if (isFileExcel("courseListFileInput")) {
                uploadCourseList();
              }
            });
          });
          




  


function uploadCourseList() {
    var formData = new FormData();
    formData.append("courseListFile", $("#courseListFileInput")[0].files[0]);
  
    $.ajax({
      type: "post",
      cache: false,
      url: "ExcelReadCourse.php",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formData,
      success: function (data, status) {

        $("#courseListUploadForm")[0].reset();
        if (data.status === "success") {


          showToast("aeToastS", "Success", data.message, "20");


        } else {
          showToast("aeToastE", "Error", data.message, "20");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
        $("#courseListUploadForm")[0].reset();
        showToast("aeToastE", "Error", "An error occurred.", "20");
      },
    });
  }
  