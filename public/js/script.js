$(document).ready(function () {
  $("#search-form").on("submit", function (event) {
    event.preventDefault(); // Prevent page reload

    // Get the search query from the input
    const query = $("#search-input").val();

    // Perform the AJAX request
    $.ajax({
      url: "search.php", // Server script to process the AJAX request
      type: "GET",
      data: { q: query },
      success: function (data) {
        // Replace the contents of the search results div with the new data
        $("#search-results").html($(data).find("#search-results").html());
      },
      error: function () {
        $("#search-results").html(
          '<p class="text-danger">An error occurred. Please try again.</p>'
        );
      },
    });
  });
});

// cart animation:
