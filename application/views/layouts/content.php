<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<!-- [ Main Content ] start -->




		<div class="d-flex justify-content-center gap-2 ">

			<div class="col-4 mb-3">
				<a href="<?= base_url('admin/dashboard/view_band_pending') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-8 order-card">
						<div class="card-body">
							<h6 class="text-white">Stok Barang</h6>
							<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><?php echo $product_stock > 0 ? $product_stock : '<p>Belum ada data</p>'; ?></h2>
						</div>
					</div>
				</a>
			</div>

			<div class="col-4 mb-3">
				<a href="<?= base_url('admin/dashboard/view_band_hadir') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-10 order-card">
						<div class="card-body">
							<h6 class="text-white">Barang Masuk</h6>
							<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><?php echo $product_stock_in > 0 ? $product_stock_in : '<p>Belum ada data</p>'; ?></h2>
						</div>
					</div>
				</a>
			</div>

			<div class="col-4 mb-3">
				<a href="<?= base_url('admin/dashboard/view_band_batal_hadir') ?>" style="text-decoration:none">
					<div class="card bg-dark order-card">
						<div class="card-body">
							<h6 class="text-white">Barang Keluar</h6>
							<h2 class="text-end text-white"><i class="feather icon-user-x float-start"></i><?php echo $product_stock_out > 0 ? $product_stock_out : '<p>Belum ada data</p>'; ?></h2>
						</div>
					</div>
				</a>
			</div>

		</div>

	</div>







</div>
<!-- [ Main Content ] end -->
</div>
</div>
<!-- [ Main Content ] end -->
<!-- 
<script>
	let currentDate = new Date();

	// Example activities for the current week
	const activitiesData = {
		"2024-11-24": ["Attend team meeting", "Write reports"],
		"2024-11-25": ["Doctor's appointment", "Work on project"],
		"2024-11-26": ["Yoga session", "Conference call"],
		"2024-11-27": ["Submit assignments", "Family dinner"],
		"2024-11-28": ["Review tasks", "Attend webinar"],
		"2024-11-29": ["Weekend trip", "Catch up with friends"],
		"2024-11-30": ["Weekend hike", "Watch movie"],
		"2024-11-17": ["Old activity", "Past event"]
	};

	// Function to get the start of the week (Sunday)
	function getStartOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() - day; // Adjust to Sunday
		return new Date(date.setDate(diff));
	}

	// Function to get the end of the week (Saturday)
	function getEndOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() + (6 - day); // Adjust to Saturday
		return new Date(date.setDate(diff));
	}

	// Function to display the current week
	function displayWeek(weekStartDate) {
		let calendarDatesDiv = document.getElementById('calendar-dates');
		let weekTitle = document.getElementById('week-title');
		let activityList = document.getElementById('activity-list');

		// Clear the existing dates and activities
		calendarDatesDiv.innerHTML = '';
		activityList.innerHTML = '';

		let startOfWeek = new Date(weekStartDate);
		let endOfWeek = getEndOfWeek(new Date(startOfWeek));
		weekTitle.textContent = `${startOfWeek.toLocaleDateString()} - ${endOfWeek.toLocaleDateString()}`;

		// Generate calendar dates and display activities for the week
		for (let i = 0; i < 7; i++) {
			let currentDay = new Date(startOfWeek);
			currentDay.setDate(startOfWeek.getDate() + i);

			let dayDiv = document.createElement('div');
			dayDiv.textContent = currentDay.getDate();
			dayDiv.dataset.date = currentDay.toISOString().split('T')[0]; // Store date in ISO format

			// Highlight today's date
			if (currentDay.toDateString() === new Date().toDateString()) {
				dayDiv.classList.add('today');
			}

			calendarDatesDiv.appendChild(dayDiv);

			// Display activities for each day of the week if they belong to the current week
			let dateString = currentDay.toISOString().split('T')[0];
			if (activitiesData[dateString]) {
				activitiesData[dateString].forEach(activity => {
					let li = document.createElement('li');
					li.textContent = `Day ${currentDay.getDate()} - ${activity}`;
					activityList.appendChild(li);
				});
			}
		}
	}

	// Navigate to the previous or next week
	function navigateWeek(offset) {
		currentDate.setDate(currentDate.getDate() + offset * 7);
		let startOfWeek = getStartOfWeek(new Date(currentDate));
		displayWeek(startOfWeek);
	}

	// Display the current week when the page loads
	displayWeek(getStartOfWeek(new Date()));
</script> -->



<script>
	let currentDate = new Date();

	// Example activities for the current week (from PHP data)
	const activitiesData = <?= json_encode($jadwal); ?>;

	// Function to get the start of the week (Sunday)
	function getStartOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() - day; // Adjust to Sunday
		return new Date(date.setDate(diff));
	}

	// Function to get the end of the week (Saturday)
	function getEndOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() + (6 - day); // Adjust to Saturday
		return new Date(date.setDate(diff));
	}

	// Function to display the current week
	function displayWeek(weekStartDate) {
		let calendarDatesDiv = document.getElementById('calendar-dates');
		let weekTitle = document.getElementById('week-title');
		let activityList = document.getElementById('activity-list');

		// Clear the existing dates and activities
		calendarDatesDiv.innerHTML = '';
		activityList.innerHTML = '';

		let startOfWeek = new Date(weekStartDate);
		let endOfWeek = getEndOfWeek(new Date(startOfWeek));
		weekTitle.textContent = `${startOfWeek.toLocaleDateString()} - ${endOfWeek.toLocaleDateString()}`;

		// Generate calendar dates and display activities for the week
		for (let i = 0; i < 7; i++) {
			let currentDay = new Date(startOfWeek);
			currentDay.setDate(startOfWeek.getDate() + i);

			let dayDiv = document.createElement('div');
			dayDiv.textContent = currentDay.getDate();
			dayDiv.dataset.date = currentDay.toISOString().split('T')[0]; // Store date in ISO format

			// Highlight today's date
			if (currentDay.toDateString() === new Date().toDateString()) {
				dayDiv.classList.add('today');
			}

			calendarDatesDiv.appendChild(dayDiv);

			// Check if there's any activity for this day
			let dateString = currentDay.toISOString().split('T')[0];
			let activitiesForDay = activitiesData.filter(activity => activity.date === dateString);

			// Display activities for the current day with date
			activitiesForDay.forEach(activity => {
				let li = document.createElement('li');
				li.textContent = `Tanggal: ${currentDay.toLocaleDateString()} - Band: ${activity.nama_band}, Konser: ${activity.nama_konser} at ${activity.nama_tempat_manggung}`;
				activityList.appendChild(li);
			});
		}
	}

	// Navigate to the previous or next week
	function navigateWeek(offset) {
		currentDate.setDate(currentDate.getDate() + offset * 7);
		let startOfWeek = getStartOfWeek(new Date(currentDate));
		displayWeek(startOfWeek);
	}

	// Display the current week when the page loads
	displayWeek(getStartOfWeek(new Date()));
</script>