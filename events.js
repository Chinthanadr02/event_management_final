
document.addEventListener("DOMContentLoaded", function () {
    const eventList = document.getElementById("event-list");
    const addEventForm = document.getElementById("add-event-form");
    const addEventButton = document.getElementById("add-event-button");
    const cancelAddEvent = document.getElementById("cancel-add-event");
    const eventForm = document.getElementById("eventForm");

    const fetchEvents = () => {
        fetch("events.php")
            .then((response) => response.json())
            .then((data) => {
                eventList.innerHTML = "";
                data.forEach((event) => {
                    const eventDiv = document.createElement("div");
                    eventDiv.textContent = `${event.name} - ${event.date}`;
                    eventList.appendChild(eventDiv);
                });
            })
            .catch((error) => console.error("Error fetching events:", error));
    };

    addEventButton.addEventListener("click", () => {
        addEventForm.style.display = "block";
    });

    cancelAddEvent.addEventListener("click", () => {
        addEventForm.style.display = "none";
    });

    eventForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(eventForm);
        fetch("events.php", {
            method: "POST",
            body: new URLSearchParams(formData),
        })
            .then(() => {
                fetchEvents();
                addEventForm.style.display = "none";
                eventForm.reset();
            })
            .catch((error) => console.error("Error saving event:", error));
    });

    fetchEvents();
});
