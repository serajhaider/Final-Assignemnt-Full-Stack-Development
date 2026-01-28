const doctor = document.getElementById("doctor_id");
const date = document.getElementById("appointment_date");
const start = document.getElementById("start_time");
const end = document.getElementById("end_time");
const availability = document.getElementById("availability");

function checkAvailability() {
    if (!doctor.value || !date.value || !start.value || !end.value) {
        availability.textContent = "";
        return;
    }

    const url = `availability.php?doctor_id=${doctor.value}&date=${date.value}&start_time=${start.value}&end_time=${end.value}`;

    fetch(url)
        .then(r => r.json())
        .then(data => {
            availability.textContent = data.message;
            availability.className = data.available ? "available" : "not-available";
        });
}

doctor.addEventListener("change", checkAvailability);
date.addEventListener("change", checkAvailability);
start.addEventListener("change", checkAvailability);
end.addEventListener("change", checkAvailability);
