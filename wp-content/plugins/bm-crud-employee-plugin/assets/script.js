jQuery(document).ready(() => {
  // Add Form Validation
  jQuery("#bm-employee-form").validate();

  // form submit

  jQuery("#bm-employee-form").on("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    jQuery.ajax({
      url: bm_form_object.ajax_url,
      data: formData,
      method: "POST",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          console.log(response.message);
          setTimeout(() => {
            location.reload();
          }, 1500);
        }
      },
    });
  });

  // Render Employees
  fetchAllEmployee();
});

// Fetch all employee from DB table
function fetchAllEmployee() {
  jQuery.ajax({
    url: bm_form_object.ajax_url,
    data: {
      action: "bm_fetch_all_employee",
    },
    method: "GET",
    dataType: "json",
    success: function (response) {
      var employeesDataHtml = "";
      jQuery.each(response.employees, function (index, employee) {
        var profileImageUrl = "--";
        if (employee.profile_image) {
          profileImageUrl = `<img src="${employee.profile_image}" alt="Profile" width="50" height="50" />`;
        }

        employeesDataHtml += `
            <tr>
                <td>${employee.id}</td>
                <td>${employee.name}</td>
                <td>${employee.email}</td>
                <td>${employee.designation}</td>
                <td>${profileImageUrl}</td>
                <td>
                    <button data-id="${employee.id}" class="btn_edit_employee">Edit</button>
                    <button data-id="${employee.id}" class="btn_delete_employee">Delete</button>
                </td>
            </tr>
        
        `;
      });

      // Bind data with table
      jQuery("#employee-list-body").html(employeesDataHtml);
    },
  });
}
