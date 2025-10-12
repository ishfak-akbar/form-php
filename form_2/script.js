//load users when page loads
document.addEventListener("DOMContentLoaded", function () {
  loadUsers();

  //setup form submissions
  setupForms();

  //setup modal events
  setupModal();
});

//load all users from server
function loadUsers() {
  fetch("process.php?action=get_users")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        displayUsers(data.data);
      } else {
        console.error("Error loading users:", data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      document.getElementById("userList").innerHTML =
        '<div class="p-8 text-center text-red-500">Error loading users</div>';
    });
}

//display users in the list
function displayUsers(users) {
  const userList = document.getElementById("userList");

  if (users.length === 0) {
    userList.innerHTML =
      '<div class="p-8 text-center text-gray-500">No users found</div>';
    return;
  }

  userList.innerHTML = users
    .map(
      (user) => `
        <li class="p-6 hover:bg-gray-50 transition duration-200" id="user-${
          user.id
        }">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            ${
                              user.firstName
                                ? user.firstName.charAt(0).toUpperCase()
                                : ""
                            }${
        user.lastName ? user.lastName.charAt(0).toUpperCase() : ""
      }
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">
                            ${user.firstName} ${user.lastName}
                        </h4>
                        <p class="text-sm text-gray-600">${user.email}</p>
                        <p class="text-xs text-gray-500">${user.phone}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-900">${
                      user.subscription
                        ? user.subscription.charAt(0).toUpperCase() +
                          user.subscription.slice(1)
                        : ""
                    } Plan</p>
                    <p class="text-sm text-gray-600">${user.gender} • ${
        user.dob
      }</p>
                    <p class="text-xs text-gray-500 mt-1 max-w-xs">${
                      user.address
                    }</p>
                </div>
                <div class="flex space-x-2">
                    <button onclick="openEditModal(${user.id})" 
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 font-semibold">
                        Edit
                    </button>
                    <button onclick="deleteUser(${user.id})" 
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200 font-semibold">
                        Delete
                    </button>
                </div>
            </div>
        </li>
    `
    )
    .join("");
}

//setup form submissions with AJAX
function setupForms() {
  const forms = document.querySelectorAll("form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      const submitButton = this.querySelector('button[type="submit"]');
      const originalText = submitButton.innerHTML;
      const isMainForm = this.id === "mainForm"; //check if this is the main form

      //show loading state
      submitButton.innerHTML = "Processing...";
      submitButton.disabled = true;

      fetch(this.action, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(data.message);

            if (isMainForm) {
              resetMainForm(); //clears all form fields
            }

            if (this.id === "editForm") {
              closeEditModal();
            }

            // Reload users list to show the new user
            loadUsers();
          } else {
            alert("Error: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("An error occurred. Please try again.");
        })
        .finally(() => {
          //restore button state
          submitButton.innerHTML = originalText;
          submitButton.disabled = false;
        });
    });
  });
}

//reset main form function
function resetMainForm() {
  const mainForm = document.getElementById("mainForm");
  if (mainForm) {
    mainForm.reset();

    //additional reset for specific fields if needed
    const dateField = mainForm.querySelector('input[type="date"]');
    if (dateField) {
      dateField.value = ""; //ensure date field is cleared
    }

    const selectFields = mainForm.querySelectorAll("select");
    selectFields.forEach((select) => {
      select.selectedIndex = 0; //reset to first option
    });

    console.log("Form reset successfully!");
  }
}

//modal functionality
function openEditModal(userId) {
  fetch(`process.php?action=get_user&id=${userId}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        const user = data.data;

        //give input in form fields
        document.getElementById("editId").value = user.id;
        document.getElementById("editFname").value = user.firstName || "";
        document.getElementById("editLname").value = user.lastName || "";
        document.getElementById("editEmail").value = user.email || "";
        document.getElementById("editPhone").value = user.phone || "";
        document.getElementById("editDob").value = user.dob || "";
        document.getElementById("editAddress").value = user.address || "";
        document.getElementById("editGender").value = user.gender || "";
        document.getElementById("editSubscription").value =
          user.subscription || "";

        //show modals
        const modal = document.getElementById("editModal");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        document.body.style.overflow = "hidden";
      } else {
        alert("Error loading user: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Error loading user data");
    });
}

function closeEditModal() {
  const modal = document.getElementById("editModal");
  modal.classList.add("hidden");
  modal.classList.remove("flex");
  document.body.style.overflow = "auto";
}

//delete user function
function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    const formData = new FormData();
    formData.append("delete", "1");
    formData.append("id", userId);

    fetch("process.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);
          loadUsers(); // Reload the users list
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while deleting the user");
      });
  }
}

//setup modal events
function setupModal() {
  const modal = document.getElementById("editModal");

  // Close when clicking outside modal content
  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeEditModal();
      }
    });
  }

  //close when pressing Escape key
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeEditModal();
    }
  });
}
