<div class="bm_employee_crud_plugin">
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
