function downloadPDF() {
    const indexNumber = $("#indexNumber").val();
  
    if (aeEmpty(indexNumber)) {
      showToast("aeToastE", "INDEX NUMBER REQUIRED", "Please enter your index number.", "20");
      return;
    }
  
    $.ajax({
      type: "post",
      cache: false,
      url: "PDFstudent.php",
      data: {
        indexNumber: indexNumber
      },
      dataType: "text",
      success: function (data, status) {
        // Assuming the PHP script sends a URL to the PDF

        aeDownload("indexnumber.pdf")
        if (data) {
          window.location.href = data;
        }
        showToast("aeToastS", "Success", "PDF generated and download initiated.", "20");
      },
      error: function (xhr, status, error) {
        showToast("aeToastE", "Error", "Failed to generate PDF.", "20");
        console.error(error);
      },
    });
  }
  
  $("#footerDownloadChoice").click(downloadPDF);
  