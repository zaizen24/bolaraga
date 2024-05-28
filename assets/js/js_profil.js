function toggleDropdown() {
    var dropdown = document.getElementById("dropdownContent");
    dropdown.classList.toggle("showprofil");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-contentprofil");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('showprofil')) {
          openDropdown.classList.remove('showprofil');
        }
      }
    }
  };
  
  function logout() {
    // Implement your logout functionality here
    // For example, redirecting the user to the logout page
    window.location.href = "logout.php"; // Change to your logout endpoint
  }
  