<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
    <link rel="stylesheet" href="assets/styles/Appointment.css">
    <title>Romel Photograph</title>

</head>

<body>

    <header>
        <div class="inner">
            <div class="logo"><img src="/assets/icons/logo.png"></div>
            <div class="burger"></div>
            <nav>
                <a href="index.php">Package</a>
                <a class="active" href="Appointment.php">Appointment</a>
                <!-- <a href="ContactUs.php">Contact Us</a> -->
                <a href="#">FAQ</a>
            </nav>

        </div>
    </header>

    <!-- <main> -->

    <div class="container">
        <!-- Left Section for Personal Info -->
        <div class="left-section">
            <h1>Book an Appointment</h1>
            <div class="reminder">
                Please be on time for your appointment.
            </div>

            <!-- Personal Details Form -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="phone">Cellphone Number:</label>
                <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
        </div>

        <!-- Partition Divider -->
        <div class="partition"></div>

        <!-- Right Section for Calendar and Appointment Booking -->
        <div class="calendar-container">
            <!-- Month and Year Selection -->
            <div class="month-select">
                <button class="nav-btn" id="prev-month">Previous</button>
                <div>
                    <label for="month-select">Select Month:</label>
                    <select id="month-select"></select>
                    <label for="year-select">Select Year:</label>
                    <select id="year-select"></select>
                </div>
                <button class="nav-btn" id="next-month">Next</button>
            </div>

            <!-- Calendar Section -->
            <div class="calendar" id="calendar"></div>

            <!-- Display selected date -->
            <div class="selected-date" id="selected-date"></div>

            <!-- Available Times Section -->
            <div class="available-times" id="available-times"></div>

            <!-- Appointment Form -->
            <form id="appointment-form" style="display: none;">
                <label for="appointment">Select an Appointment Type:</label>
                <select id="appointment" name="appointment" required>
                    <option value="consultation">Consultation</option>
                    <option value="checkup">Check-up</option>
                    <option value="followup">Follow-up</option>
                </select>

                <button type="submit" class="submit-btn">Book Appointment</button>
            </form>
        </div>
    </div>


    <!-- </main> -->

    <script>
    // Example of available time slots for each day
    const availableTimes = {
        // Assuming all dates in the month will have available time slots
        // Add time slots for all days in the month (you can define the time slots as needed)
        1: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        2: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        3: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        4: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        5: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        6: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        7: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        8: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        9: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        10: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        11: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        12: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        13: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        14: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        15: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        16: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        17: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        18: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        19: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        20: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        21: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        22: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        23: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        24: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        25: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        26: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        27: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        28: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        29: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        30: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM'],
        31: ['8:00 AM', '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM']
    };


    let selectedDate = null;
    let selectedTimeSlot = null; // Track the currently selected time slot
    let currentMonth = 0;
    let currentYear = 2025;

    // Populate months and years in dropdowns
    function populateMonthYear() {
        const monthSelect = document.getElementById('month-select');
        const yearSelect = document.getElementById('year-select');

        monthSelect.innerHTML = '';
        const months = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        months.forEach((month, index) => {
            const option = document.createElement('option');
            option.value = index;
            option.textContent = month;
            monthSelect.appendChild(option);
        });

        yearSelect.innerHTML = '';
        for (let year = 2025; year <= 2030; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }

        monthSelect.value = currentMonth;
        yearSelect.value = currentYear;
    }

    function generateCalendar() {
        const calendar = document.getElementById('calendar');
        const selectedDateDisplay = document.getElementById('selected-date');
        const availableTimesSection = document.getElementById('available-times');
        const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
        const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
        const totalDaysInMonth = lastDayOfMonth.getDate();
        const availableDates = Object.keys(availableTimes).map(Number);

        // Get today's date
        const today = new Date();
        const todayDay = today.getDate();
        const todayMonth = today.getMonth();
        const todayYear = today.getFullYear();

        // Clear previous calendar
        calendar.innerHTML = '';

        // Add day names (Sun-Sat)
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        daysOfWeek.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.innerText = day;
            calendar.appendChild(dayElement);
        });

        // Fill in empty spaces before the 1st day of the month
        for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
            const emptyElement = document.createElement('div');
            calendar.appendChild(emptyElement);
        }

        // Generate calendar dates
        for (let day = 1; day <= totalDaysInMonth; day++) {
            const dateElement = document.createElement('div');
            dateElement.innerText = day;

            // Disable past dates
            if (
                currentYear < todayYear ||
                (currentYear === todayYear && currentMonth < todayMonth) ||
                (currentYear === todayYear && currentMonth === todayMonth && day < todayDay)
            ) {
                dateElement.classList.add('disabled'); // Add a class to style disabled dates
                dateElement.style.pointerEvents = 'none'; // Disable click event
                dateElement.style.opacity = 0.5; // Make it visually different (optional)
            } else if (availableDates.includes(day)) {
                dateElement.classList.add('available');
                dateElement.addEventListener('click', () => {
                    selectedDate = day;
                    selectedDateDisplay.innerText = `Selected Date: ${currentMonth + 1}/${day}/${currentYear}`;
                    displayAvailableTimes(day);
                });
            }

            calendar.appendChild(dateElement);
        }
    }

    // Function to display available time slots
    function displayAvailableTimes(day) {
        const availableTimesSection = document.getElementById('available-times');
        availableTimesSection.innerHTML = '';

        if (availableTimes[day]) {
            availableTimes[day].forEach(time => {
                const timeSlot = document.createElement('div');
                timeSlot.classList.add('time-slot');
                timeSlot.innerText = time;
                timeSlot.addEventListener('click', () => {
                    selectTimeSlot(timeSlot, time);
                });
                availableTimesSection.appendChild(timeSlot);
            });

            document.getElementById('appointment-form').style.display = 'block';
        } else {
            availableTimesSection.innerText = 'No available times for this date.';
            document.getElementById('appointment-form').style.display = 'none';
            selectedDateDisplay.innerText = '';
        }
    }

    // Function to handle time slot selection
    function selectTimeSlot(timeSlotElement, time) {
        const selectedDateDisplay = document.getElementById('selected-date');
        selectedDateDisplay.innerText = `Selected Date: ${currentMonth + 1}/${selectedDate}/${currentYear} at ${time}`;

        // Deselect previously selected time slot
        if (selectedTimeSlot) {
            selectedTimeSlot.classList.remove('selected'); // Remove class from previously selected time slot
        }

        // Mark the clicked slot as selected
        selectedTimeSlot = timeSlotElement; // Store the currently selected time slot
        selectedTimeSlot.classList.add('selected'); // Add selected class to the current time slot
    }

    // Navigation buttons
    document.getElementById('prev-month').onclick = function() {
        if (currentMonth === 0) {
            currentMonth = 11; // Go to December
            currentYear--;
        } else {
            currentMonth--;
        }
        populateMonthYear();
        generateCalendar();
    };

    document.getElementById('next-month').onclick = function() {
        if (currentMonth === 11) {
            currentMonth = 0; // Go to January
            currentYear++;
        } else {
            currentMonth++;
        }
        populateMonthYear();
        generateCalendar();
    };

    // Event listeners for month and year selection
    document.getElementById('month-select').addEventListener('change', function() {
        currentMonth = parseInt(this.value);
        generateCalendar();
    });

    document.getElementById('year-select').addEventListener('change', function() {
        currentYear = parseInt(this.value);
        generateCalendar();
    });

    // Initialize the calendar interface
    populateMonthYear();
    generateCalendar();
    </script>
</body>

</html>