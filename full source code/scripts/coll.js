/*
  	Created by: millier - 1/04/2023
	  modified last: Ethan PP Cutting - 6/05/2023
*/

  function initializeCollapsible() {
    var coll = document.getElementsByClassName("collapsible");

    for (var i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (window.getComputedStyle(content).display === "none") {
          content.style.display = "block";
        } else {
          content.style.display = "none";
        }
      });
    }
  }

  window.onload = function() {
    initializeCollapsible();
    // Hide the benefits initially
    var benefitsContent = document.getElementById("benefits-side-2");
    benefitsContent.style.display = "none";
  };

