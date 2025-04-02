const dashboardElement = document.getElementById("dashboard");
let showingDashboard = true;

function updateDashboard() {
  if (showingDashboard) {
    dashboardElement.style.opacity = 0;
    setTimeout(() => {
      const now = new Date();
      const options = { year: "numeric", month: "long", day: "numeric" };
      const formattedDate = now.toLocaleDateString(undefined, options);
      dashboardElement.textContent = formattedDate;
      dashboardElement.style.opacity = 1;
      showingDashboard = false;
    }, 1000); // Wait for fade-out before changing content
  } else {
    dashboardElement.style.opacity = 0;
    setTimeout(() => {
      dashboardElement.textContent = "Dashboard";
      dashboardElement.style.opacity = 1;
      showingDashboard = true;
    }, 900); // Wait for fade-out before changing content
  }
}

setInterval(updateDashboard, 10000); // Change every 10 seconds (10000 ms)

function updateTime() {
  const timeElement = document.getElementById("dashboardTime");
  const now = new Date();
  const hours = String(now.getHours()).padStart(2, "0");
  const minutes = String(now.getMinutes()).padStart(2, "0");
  const seconds = String(now.getSeconds()).padStart(2, "0");
  timeElement.textContent = `${hours}:${minutes}:${seconds}`;
}

updateDashboard();
updateTime();
setInterval(updateTime, 1000);
