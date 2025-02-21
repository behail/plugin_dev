<div class="bm_employee_crud_plugin">
    <!-- Add Employee Form -->
     <div class="hide-element add_employee_form">
         <button id="btn_close_add_empl_form" style="float: right;" >Close Form</button>
         <h3>Add Employee</h3>
         <form action="javascript:void(0);" id="bm-employee-form" enctype="multipart/form-data">
             <input type="hidden" name="action" value="bm_add_employee">
             <p>
                 <label for="name">Name</label>
                 <input required type="text" name="name" id="name" placeholder="Enter Name">
             </p>
             <p>
                 <label for="email">Email</label>
                 <input required type="email" name="email" id="email" placeholder="Enter Email">
             </p>
             <p>
                 <label for="designation">Designation</label>
                 <select required name="designation" id="designation">
                     <option value="">--Select Designation--</option>
                     <option value="php">PHP Developer</option>
                     <option value="fullstack">Full Stack Developer</option>
                     <option value="wordpress">WordPress Developer</option>
                     <option value="java">JavaScript Developer</option>
                 </select>
             </p>
             <p>
                 <label for="profile_image">Profile Image</label>
                 <input type="file" name="profile_image" id="profile_image">
             </p>
             <p>
                 <button id="btn-save-data" type="submit">Submit</button>
             </p>
         </form>
     </div>
    <!-- Add Employee Form End -->

     <!-- Edit Employee Form -->
      <div class="hide-element edit_employee_form">
         <button id="btn_close_edit_empl_form" style="float: right;" >Close Form</button>
          <h3>Edit Employee</h3>
          <form action="javascript:void(0);" id="bm-edit_employee-form" enctype="multipart/form-data">
              <input type="hidden" name="action" value="bm_edit_employee">
              <p>
                  <label for="emp_name">Name</label>
                  <input required type="text" name="emp_name" id="emp_name" placeholder="Enter Name">
              </p>
              <p>
                  <label for="emp_email">Email</label>
                  <input required type="emp_email" name="emp_email" id="emp_email" placeholder="Enter Email">
              </p>
              <p>
                  <label for="emp_designation">Designation</label>
                  <select required name="emp_designation" id="emp_designation">
                      <option value="">--Select Designation--</option>
                      <option value="php">PHP Developer</option>
                      <option value="fullstack">Full Stack Developer</option>
                      <option value="wordpress">WordPress Developer</option>
                      <option value="java">JavaScript Developer</option>
                  </select>
              </p>
              <p>
                  <label for="emp_profile_image">Profile Image</label>
                  <input type="file" name="emp_profile_image" id="emp_profile_image">
              </p>
              <p>
                  <button id="btn-update-data" type="submit">Save Update</button>
              </p>
          </form>

      </div>
    <!-- Edit Employee Form End -->
    <div>
        <button id="btn_open_add_empl_form" style="float: right;" >Add Employee</button>
        <h3>Employee List</h3>
        <table id="employee-list">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>#Name</th>
                    <th>#Email</th>
                    <th>#Designation</th>
                    <th>#Profile Image</th>
                    <th>#Action</th>
                </tr>
            </thead>
            <tbody id="employee-list-body">
                
            </tbody>
        </table>

    </div>
</div>
