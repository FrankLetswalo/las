<!-- Description -->
<div class="modal fade" id="description">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
                <p id="desc"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Module</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="module_add.php" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Subject Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="subject_code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Subject Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                <label for="course" class="col-sm-3 control-label">Course Code</label>
                    <select id="course" class="form-group has-feedback" name="course_code" style="margin-left: 15px;margin-right: 0px;padding-bottom: 20px;padding-right: 416px;">
                        <option selected>Select Course</option>

                    
                    </select>

                </div>   
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Total No. of students</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="no_students" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Lecture Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="lecture" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Module</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="module_edit.php" enctype="multipart/form-data">
              <input type="hidden" class="id" id="id" name="courseID">
              <div class="form-group">
                    <label for="code" class="col-sm-3 control-label">Subject Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="code" name="subject_code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Subject Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="subject_name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                <label for="course_code" class="col-sm-3 control-label">Course Code</label>
            
                <div class="col-sm-9">
                <input type="text" class="form-control" id="course_code" name="course_code" readonly required>
                    </div>

                </div>    
                <div class="form-group">
                    <label for="students" class="col-sm-3 control-label">Total No. of students</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="students" name="no_students" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lecture" class="col-sm-3 control-label">Lecture Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lecture" name="lecture" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="module_delete.php">
                <input type="hidden" class="prodid" id="code" name="id">
                <div class="text-center">
                    <p>DELETE MODULE</p>
                    <h2 class="bold name"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>