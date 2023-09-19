<div id="indexwrapper" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                 <div class="row">
                    <div class="col-6">
                    <label for="indexNumber">Index Number:</label>
                 
                    </div>
                    <div class="col-6">
                    <input type="text" class="form-control" name="indexNumber" id="indexNumber" placeholder="Enter Index Number">
                
                    </div>
                 </div>
                
                </div>
            </div>
        </div>
    </div>
</div>


<div id="saveWrapper"  class="container-fluid justify-content-center align-items-center">
    <div class="col container-fluid display-flex justify-content-center align-items-center text-center p-2">
    <a href="PDFstudent.php">
   <i id="footerDownloadChoice1" class="fa fa-download fa-2x me-2" aria-hidden="true" data-toggle="tooltip" title="Download your responses"></i>
   </a>
    <i id="saveChoice" class="fa fa-floppy-o fa-2x" aria-hidden="true" data-toggle="tooltip" title="Save your responses"></i>
    </div>

    
</div>






<div id="studentCardContainer">
  <div class="issueCard">
    <div class="card courseIssueCard m-1">
      <div class="card issueHeaderCard">
      <span class="close-icon" id="clearSelection" data-toggle="tooltip" title="Click to clear selection"><i class="fa fa-trash" aria-hidden="true"></i></span>

        <h5 class="card-title"> <span id="courseCode">COURSE CODE</span id="courseTitle">TITLE</h5>
      </div>
      <div class="card issueOptionsCard" id="issueSection">
        <div class="card issueICCard">
          <label>
            <input type="radio" name="studentIssue" id="studentIC" value="IC"> 
            IC
          </label>
        </div>
        <div class="card issueNotInPortalCard">
          <label>
            <input type="radio" name="studentIssue" id="studentNotInPortal" value="NOT IN PORTAL"> 
            NOT IN PORTAL
          </label>
        </div>
        <div class="card issueOtherCard">
          <label>
            <input type="radio" name="studentIssue" id="studentOther" value="OTHER"> 
            OTHER
          </label>
        </div>
        <div class="card issueOtherTextareaCard" id="studentOtherTextarea" style="display: none;">
          <textarea class="form-control" name="studentOther" id="studentOtherTextarea" placeholder="Specify Issue"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>




<div id="footerWrapper" class="container-fluid fixed-bottom">
  <div id="footerCol" class="col container-fluid d-flex justify-content-center align-items-center text-center p-2">
   <a href="PDFstudent.php">
   <i id="footerDownload" class="fa fa-download fa-2x me-2" aria-hidden="true" data-toggle="tooltip" title="Download your responses"></i>
   </a>
    <i id="footerSaveChoice" class="fa fa-floppy-o fa-2x" aria-hidden="true" data-toggle="tooltip" title="Save your responses"></i>
  </div>
</div>
