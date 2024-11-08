<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job-Seeker Wall Post</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php 
        include('header.php');
    ?>
    <div class="full-page-form">
        <a href="job_seeker_wall.php" class="close-button">&times;</a>
        <h2>Create Wall Post</h2>
        <form id="createPostForm" onsubmit="submitPost(event)" action="../php/submit_post.php" method="POST">
            <label for="skills">Skill:</label>
            <select id="skills" name="skills" required>
              <option value="" disabled selected>Select a category</option>
              <option value="Customer Service">Customer Service</option>
              <option value="Technology">Technology</option>
              <option value="Photographic">Photographic</option>
              <option value="Creative Skills">Creative Skills</option>
              <option value="Teaching and Tutoring">Teaching and Tutoring</option>
              <option value="Writing and Editing">Writing and Editing</option>
              <!-- Add more categories as needed -->
            </select><br>
            

            <label for="skillDetails">Skill Details:</label><br>
            <textarea id="skillDetails" name="skillDetails" rows="4" maxlength="250" placeholder="Describe your skills in this category (max 50 words)" required></textarea><br>

            <label>Availability:</label>
            <div class="availability-slots">
                <div class="availability-slot">
                    <label>Monday</label>
                    <input type="time" name="mondayStart" placeholder="Start Time">
                    <input type="time" name="mondayEnd" placeholder="End Time">
                </div>
                <div class="availability-slot">
                    <label>Tuesday</label>
                    <input type="time" name="tuesdayStart" placeholder="Start Time">
                    <input type="time" name="tuesdayEnd" placeholder="End Time">
                </div>
                <div class="availability-slot">
                    <label>Wednesday</label>
                    <input type="time" name="wednesdayStart" placeholder="Start Time">
                    <input type="time" name="wednesdayEnd" placeholder="End Time">
                </div>
                <div class="availability-slot">
                    <label>Thursday</label>
                    <input type="time" name="thursdayStart" placeholder="Start Time">
                    <input type="time" name="thursdayEnd" placeholder="End Time">
                </div>
                <div class="availability-slot">
                    <label>Friday</label>
                    <input type="time" name="fridayStart" placeholder="Start Time">
                    <input type="time" name="fridayEnd" placeholder="End Time">
                </div>
                <div class="availability-slot">
                    <label>Saturday</label>
                    <input type="time" name="saturdayStart" placeholder="Start Time">
                    <input type="time" name="saturdayEnd" placeholder="End Time">
                </div>
                <div class="availability-slot">
                    <label>Sunday</label>
                    <input type="time" name="sundayStart" placeholder="Start Time">
                    <input type="time" name="sundayEnd" placeholder="End Time">
                </div>
            </div>

            <label for="state">State:</label>
            <select id="state" name="state" required onchange="updateDistricts()">
                <option value="">Select a State</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Penang">Penang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
            </select>

            <label for="district">District:</label>
            <select id="district" name="district" required>
                <option value="">Select a District</option>
            </select>

            <label for="jobPreferences">Job Preferences (max 50 words):</label>
            <textarea id="jobPreferences" name="jobPreferences" rows="3" maxlength="250"></textarea><br>

            <label for="contactEmail">Email:</label>
            <input type="email" id="contactEmail" name="contactEmail" style="height:30px" required><br>

            <label for="contactPhone" >Phone Number:</label>
            <input type="tel" id="contactPhone" name="contactPhone" style="height:30px" required ><br>

            <button type="submit">Submit Post</button>
        </form>
        
    </div>

    <script>
        const districtsByState = {
            "Johor": ["Johor Bahru", "Batu Pahat", "Kluang", "Kota Tinggi", "Muar", "Segamat", "Pontian", "Mersing"],
            "Kedah": ["Alor Setar", "Kulim", "Langkawi", "Baling", "Pendang", "Sik"],
            "Kelantan": ["Kota Bharu", "Bachok", "Pasir Mas", "Tanah Merah", "Machang", "Tumpat"],
            "Kuala Lumpur": ["Bukit Bintang", "Cheras", "Kepong", "Lembah Pantai", "Segambut"],
            "Melaka": ["Alor Gajah", "Melaka Tengah", "Jasin"],
            "Negeri Sembilan": ["Seremban", "Port Dickson", "Jempol", "Rembau", "Tampin"],
            "Pahang": ["Kuantan", "Bentong", "Cameron Highlands", "Jerantut", "Raub"],
            "Penang": ["George Town", "Balik Pulau", "Butterworth", "Batu Ferringhi"],
            "Perak": ["Ipoh", "Taiping", "Teluk Intan", "Batu Gajah", "Sungai Siput"],
            "Perlis": ["Kangar", "Arau", "Padang Besar"],
            "Sabah": ["Kota Kinabalu", "Sandakan", "Tawau", "Lahad Datu"],
            "Sarawak": ["Kuching", "Sibu", "Miri", "Bintulu"],
            "Selangor": ["Shah Alam", "Petaling Jaya", "Klang", "Ampang", "Gombak"],
            "Terengganu": ["Kuala Terengganu", "Kemaman", "Besut", "Dungun"]
        };

        function updateDistricts() {
            const stateSelect = document.getElementById("state");
            const districtSelect = document.getElementById("district");
            const selectedState = stateSelect.value;

            // Clear existing districts
            districtSelect.innerHTML = '<option value="">Select a District</option>';

            if (selectedState && districtsByState[selectedState]) {
                districtsByState[selectedState].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        }

    </script>

     
    <?php include('footer.php'); ?>
</body>
</html>
