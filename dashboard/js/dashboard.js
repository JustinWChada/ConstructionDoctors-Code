$(document).ready(function () {
  $("#spinner").removeClass("show");
  $("#spinner").addClass(" hide");

  //$("#spinner").hide(); // or $("#spinner").addClass("hide");
});

function updateTime() {
  const timeElement = document.getElementById("dashboardTime");
  const now = new Date();
  const hours = String(now.getHours()).padStart(2, "0");
  const minutes = String(now.getMinutes()).padStart(2, "0");
  const seconds = String(now.getSeconds()).padStart(2, "0");
  timeElement.textContent = `${hours}:${minutes}:${seconds}`;
}

updateTime();
setInterval(updateTime, 1000);

dashboardPlane = document.getElementById("dashboardPlane");

function displayStatistic() {
  $.ajax({
    url: "statistics.php",
    method: "POST",
    data: { action: "get_statistics" },
    success: function (data) {
      $("#dashboardPlane").html(data); //Correct way to set the HTML content
    },
    error: function (xhr, status, error) {
      // Add error handling
      console.error("Error fetching statistics:", status, error);
      $("#dashboardPlane").html("Error loading statistics.");
    },
  });
}

function displayMessages() {
  $.ajax({
    url: "contact_messages/show_messages.php",
    method: "POST",
    data: { action: "get_messages" },
    success: function (data) {
      $("#dashboardPlane").html(data); //Correct way to set the HTML content
    },
    error: function (xhr, status, error) {
      // Add error handling
      console.error("Error fetching statistics:", status, error);
      $("#dashboardPlane").html("Error loading messages.");
    },
  });
}

function displayQuotes() {
  $.ajax({
    url: "quotes/show_quotes.php",
    method: "POST",
    data: { action: "get_quotes" },
    success: function (data) {
      $("#dashboardPlane").html(data); //Correct way to set the HTML content
    },
    error: function (xhr, status, error) {
      // Add error handling
      console.error("Error fetching statistics:", status, error);
      $("#dashboardPlane").html("Error loading quotes.");
    },
  });
}

function displayTestimonials() {
  $.ajax({
    url: "testimonials/show_testimonials.php",
    method: "POST",
    data: { action: "get_testimonials" },
    success: function (data) {
      $("#dashboardPlane").html(data); //Correct way to set the HTML content
    },
    error: function (xhr, status, error) {
      // Add error handling
      console.error("Error fetching statistics:", status, error);
      $("#dashboardPlane").html("Error loading testimonials.");
    },
  });
}

/**
 * Function to get the value of a specific URL parameter.
 *
 * @param {string} parameterName The name of the parameter to retrieve.
 * @param {string} url (Optional) The URL to parse. If not provided, the current page URL is used.
 * @returns {string|null} The value of the parameter, or null if the parameter is not found.
 */
function getUrlParameter(parameterName, url) {
  // If no URL is provided, use the current page's URL
  url = url || window.location.href;

  // Sanitize parameterName to avoid unexpected behavior
  parameterName = parameterName.replace(/[\[\]]/g, "\\$&"); // Escape special characters

  // Create a regular expression to find the parameter
  const regex = new RegExp("[?&]" + parameterName + "(=([^&#]*)|&|#|$)");
  const results = regex.exec(url);

  if (!results) {
    return null; // Parameter not found
  }

  if (!results[2]) {
    return ""; // Parameter present but without a value (e.g., ?myparam)
  }

  // Decode the URI component (e.g., convert %20 to spaces)
  return decodeURIComponent(results[2].replace(/\+/g, " ")); // + is replaced with space
}

// Example Usage:

// Get the value of the 'id' parameter from the current URL:
const messages = getUrlParameter("messages");
const statistics = getUrlParameter("statistics");
const quotes = getUrlParameter("quotes");
const testimonials = getUrlParameter("testimonials");

if (messages !== null) {
  displayMessages();
} else if (messages !== null) {
  displayStatistic();
} else if (quotes !== null) {
  displayQuotes();
} else if (testimonials !== null) {
  displayTestimonials();
} else {
  displayStatistic();
}
