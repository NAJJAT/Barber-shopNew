// public/js/calendar.js

const calendarDays = document.getElementById("calendarDays");
const monthYear = document.getElementById("monthYear");
let selectedDate;
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

function renderCalendar(month, year) {
    const firstDay = new Date(year, month).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();
    
    calendarDays.innerHTML = "";
    monthYear.textContent = `${new Date(year, month).toLocaleString("default", { month: "long" })} ${year}`;

    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("empty-cell");
        calendarDays.appendChild(emptyCell);
    }

    for (let day = 1; day <= lastDate; day++) {
        const dateCell = document.createElement("div");
        dateCell.classList.add("date-cell");
        dateCell.textContent = day;

        const fullDate = new Date(year, month, day);
        dateCell.onclick = () => openModal(fullDate);
        calendarDays.appendChild(dateCell);
    }
}

function changeMonth(offset) {
    currentMonth += offset;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    } else if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendar(currentMonth, currentYear);
}

function openModal(date) {
    selectedDate = date.toISOString().split("T")[0];
    document.getElementById("appointmentTime").value = selectedDate; // Update with selected date
    document.getElementById("appointmentModal").style.display = "block";
}

function closeModal() {
    document.getElementById("appointmentModal").style.display = "none";
}

// Initialize calendar on page load
renderCalendar(currentMonth, currentYear);
