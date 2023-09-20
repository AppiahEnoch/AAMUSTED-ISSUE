
<div class="modal fade" id="uploadLecturesModal" tabindex="-1" aria-labelledby="uploadLecturesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadLecturesModalLabel">ADMIN ONLY</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Bootstrap Card -->
        <div class="card">
          <div class="card-body">
            
            <!-- Passcode Input -->
            <div class="mb-3 ">
              <label for="passcodeInput">Passcode</label>
              <input type="text" class="form-control" id="passcodeInput" placeholder="Enter passcode" required>
            </div>
            
            <!-- File Input for Uploading CourseList -->
        <form class="d-none" id="courseListUploadForm">
          <a href="courseTemplate.xlsx" download="courseTemplate.xlsx">
            <img id="template" src="dev_image/excel.png" alt="">
          </a>
        <div class="upload-section">
              <label for="courseListFileInput">Upload Course List (only .xlsx)</label>
              <input type="file" id="courseListFileInput" name="courseListFile" accept=".xlsx">
            </div>
        </form>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <div class="row">


  <div id="drow" class="row d-none">
  <div class="col-9 icon-row">
    <a href="EXCEL_ADMIN.php">
      <i id="downloadAllList" class="fa fa-download fa-2x" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to download ALL LIST"></i>
    </a>
    <a href="EXCEL_IC_LIST.php">
      <i id="downloadICList" class="fa fa-download fa-2x" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to download IC LIST"></i>
    </a>
    <a href="EXCEL_NOT_ON_PORTAL.php">
      <i id="downloadNotOnPortal" class="fa fa-download fa-2x" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to download NOT ON PORTAL LIST"></i>
    </a>
    <a href="EXCEL_COURSE_LIST.php">
      <i id="downloadCourseList" class="fa fa-download fa-2x" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to download BASED ON COURSES LIST"></i>
    </a>
  </div>
  <div class="col-3">
    <button type="button" id="closeModalButton" class="btn btn-secondary" data-bs-dismiss="modal">delete courses</button>
 
  </div>
</div>


</div>


      </div>
    </div>
  </div>
</div>



<!-- Student Instructions Modal -->
<div class="modal fade" id="studentInstructionsModal" tabindex="-1" aria-labelledby="studentInstructionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentInstructionsModalLabel">FOR STUDENTS WITH COURSE ISSUES ONLY</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Bootstrap Card -->
        <div class="card">
          <div class="card-body">
            <h6>Instructions for Filling the Form</h6>
            <!-- Instructions -->
            <div class="mb-3">
  <p>
    WARNING:This is For Students Experiencing Course Issues Only!
  </p>
  <p>
    Follow these steps carefully:
    <br>
    1. Input your current Index Number.
    <br>
    2. Select the specific course you have issues with.
    <br>
    3. Choose the type of issue you are facing.
    <br>

    <br>
    4.click on Save.
    <br>

  </p>
</div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
