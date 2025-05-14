document
  .querySelectorAll(".hamburger-menu, .sidebar-removebg, .close-sidebar")
  .forEach(function (element) {
    element.addEventListener("click", function () {
      document.querySelector(".sidebar").classList.toggle("-translate-x-full");
      document.querySelector(".sidebar-removebg").classList.toggle("opacity-0");
      document.querySelector(".sidebar-removebg").classList.toggle("invisible");
    });
  });

document.querySelectorAll(".sidebar-dropdown > a").forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    const parent = link.parentElement;
    const submenu = parent.querySelector(".sidebar-submenu");
    const isOpen = parent.classList.contains("open");

    // Close all dropdowns
    document.querySelectorAll(".sidebar-dropdown").forEach((dropdown) => {
      if (dropdown !== parent) {
        dropdown.classList.remove("open");
        const sub = dropdown.querySelector(".sidebar-submenu");
        if (sub) {
          sub.style.maxHeight = sub.scrollHeight + "px"; // set it first to enable transition
          requestAnimationFrame(() => {
            sub.style.maxHeight = "0px";
          });
        }
      }
    });

    if (!isOpen) {
      parent.classList.add("open");
      submenu.style.maxHeight = submenu.scrollHeight + "px";
    } else {
      // Smooth close
      submenu.style.maxHeight = submenu.scrollHeight + "px"; // set to current height
      requestAnimationFrame(() => {
        submenu.style.maxHeight = "0px";
      });

      parent.classList.remove("open");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const notificationWrapper = document.querySelector(".notification");
  const notificationBtn = document.querySelector(".notification-btn");
  const notificationContent = document.querySelector(".notification-item");

  const profileWrapper = document.querySelector(".profile");
  const profileBtn = document.querySelector(".profile > button");
  const profileContent = document.querySelector(".profile-item");

  // Toggle notification panel
  // notificationBtn.addEventListener("click", function (e) {
  //   e.stopPropagation();

  //   // Close profile dropdown if open
  //   profileContent.classList.remove("visible", "opacity-100");

  //   // Toggle notification dropdown
  //   notificationContent.classList.toggle("visible");
  //   notificationContent.classList.toggle("opacity-100");
  // });

  // Toggle profile dropdown
  profileBtn.addEventListener("click", function (e) {
    e.stopPropagation();

    // Close notification dropdown if open
    notificationContent.classList.remove("visible", "opacity-100");

    // Toggle profile dropdown
    profileContent.classList.toggle("visible");
    profileContent.classList.toggle("opacity-100");
  });

  // Close all dropdowns when clicking outside
  document.addEventListener("click", function (e) {
    if (!notificationWrapper.contains(e.target)) {
      notificationContent.classList.remove("visible", "opacity-100");
    }
    if (!profileWrapper.contains(e.target)) {
      profileContent.classList.remove("visible", "opacity-100");
    }
  });
});


document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
  toggle.addEventListener('click', function(e) {
    e.stopPropagation(); // prevent click from bubbling to document

    // Remove 'active' class from all dropdown menus
    document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
      menu.classList.remove('active');
    });

    // Toggle 'active' class on the next sibling with class 'dropdown-menu'
    const nextMenu = toggle.nextElementSibling;
    if (nextMenu && nextMenu.classList.contains('dropdown-menu')) {
      nextMenu.classList.toggle('active');
    }
  });
});

document.addEventListener('click', function(e) {
  if (!e.target.closest('.dropdown-menu') && !e.target.closest('.dropdown-toggle')) {
    document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
      menu.classList.remove('active');
    });
  }
});