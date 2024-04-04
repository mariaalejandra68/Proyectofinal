document.querySelectorAll(".link").forEach(function(link) {
    link.addEventListener("click", function(event) {
      event.preventDefault();
      var linkHref = link.getAttribute("href");
      document.querySelector("#spinner").classList.remove("d-none");
      setTimeout(function() {
        window.location.href = linkHref;
      }, 100);
    });
});
