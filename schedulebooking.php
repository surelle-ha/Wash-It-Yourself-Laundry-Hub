<?php
    session_start();
    include "php/environment.php";
    include "php/init.php";
    include "php/mobileDetect.php";
    include "php/iniParser.php";
    include "php/connection.php";
    include "php/notification.php";
    include "php/dataIn.php";
    include "php/login.php";
    include "php/employee.php";
    include "php/manageCart.php";

    /* USER VERIFY */
    if(isset($_SESSION['logged_status'])){

    }else{
        header('location: landing.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/schedulebooking-style.css">
    <link rel="stylesheet" href="css/calendar-style.css">
    <title>Schedule | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <!-- multistep form -->
    <form id="msform" method="GET">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Service Selection</li>
        <li>Appointment</li>
        <li>Weighting</li>
        <li>Personal Details</li>
        <li>Payment</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">This is step 1</h2>
        <h3 class="fs-subtitle">Select Service</h3>
		<div>
            <style scoped>
                @import url("https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap");
        
                *,
                *:before,
                *:after {
                    box-sizing: border-box;
                }
        
                :root {
                    --primary-font: "Poppins", sans-serif;
                    --margin-x: 1em;
                    --accent-1: #6d6ae2;
                    --accent-2: #563677;
                    --accent-3: #6865ff;
                    --black: #212733;
                    --pink: #f3659a;
                }
        
                html,
                body {
                    font-family: var(--primary-font);
                    color: var(--black);
                    line-height: 1.3;
                    max-width: 1250px;
                    margin: 0 auto;
                }
        
                .accent-1 {
                    color: var(--accent-1);
                }
        
                .accent-2 {
                    color: var(--accent-2);
                }
        
                ul {
                    padding: 0;
                }
        
                li {
                    list-style: none;
                }
        
                a {
                    color: unset;
                    text-decoration: unset;
                }
        
                .nav {
                    margin: 0 var(--margin-x);
                }
        
                .nav__list {
                    display: grid;
                    grid-auto-flow: column;
                    align-items: center;
                    justify-content: flex-end;
                    grid-gap: 1em;
                }
        
                .nav__list-item--bordered {
                    border: 1px solid var(--accent-1);
                    border-radius: 20px;
                    color: var(--accent-1);
                    padding: 0.5em 1.1em;
                }
        
                .pricing {
                    text-align: center;
                    margin: 0 1em;
                }
        
                .plan-duration {
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                    margin: 0 auto;
                    width: 200px;
                }
        
                .plan-duration__toggle {
                    width: 45px;
                    height: 25px;
                    background: linear-gradient(130deg, var(--pink), #4e93f1);
                    border-radius: 16px;
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    transition: justify-content 0.2s;
                }
        
                .plan-duration__toggle-ball {
                    --size: 18px;
                    margin: 0 4px;
                    width: var(--size);
                    height: var(--size);
                    border-radius: 50%;
                    background: white;
                }
        
                .plan-duration__text {
                    color: #21273399;
                }
        
                .plan-duration--active {
                    color: var(--black);
                    font-weight: bold;
                }
        
                .plans__list {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    margin: 1.5em 0;
                }
        
                .plan__item {
                    --radius: 10px;
                    border-radius: var(--radius);
                    box-shadow: 1px 2px 15px rgba(80, 80, 80, 0.12);
                    margin: 1rem;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
        
                .plan__item--active {
                    box-shadow: 0 0 55px rgba(80, 80, 80, 0.25);
                    // todo
                    height: 350px;
                }
        
                .plan__title {
                    color: var(--accent-1);
                    margin-bottom: -0.5em;
                }
        
                .plan__price {
                    font-size: 2.5em;
                }
        
                .plan__price:before {
                    content: "Php";
                    font-size: 1rem;
                }
        
                .plan__cta-link {
                    color: var(--accent-3);
                    padding: 1em 5em;
                    border-radius: 0 0 var(--radius) var(--radius);
                }
        
                .plan__cta-link--active {
                    background: var(--accent-3);
                    color: white;
                }
        
                .plan__feature-list {
                    display: grid;
                    grid-row-gap: 0.6em;
                    justify-content: space-around;
                }
        
                .plans__special-offer a {
                    color: var(--accent-2);
                    text-decoration: underline;
                    text-decoration-color: var(--accent-2);
        
                }
        
                .currency {
                    margin: 2em var(--margin-x);
                    display: grid;
                    justify-content: flex-end;
                    grid-gap: .5em;
                    grid-auto-flow: column;
                    align-items: center;
                }
        
                .currency__select {
                    border-radius: 15px;
                    border: none;
                    background: #eee;
                    font-weight: bold;
                    padding: 2px 4px;
                }
        
                @media only screen and (min-width:618px) and (max-width: 900px) {
                    .plan__item--active {
                        order: 1;
                    }
                }
            </style>
            <hr>
            <section class="pricing">
				<article class="plans">
					<div class="plans__list">
						<article class="plan__item">
							<div class="plan__header">
								<h2 class="plan__title">Self Service</h2>
								<h1 class="plan__price">180</h1>
							</div>
							<a href="#" class="plan__cta-link" data-price="180">Select</a>
						</article>
						<article class="plan__item plan__item--active">
							<div class="plan__header">
								<h2 class="plan__title">Full Service</h2>
								<h1 class="plan__price">210</h1>
							</div>
							<a href="#" class="plan__cta-link plan__cta-link--active" data-price="210">Select</a>
						</article>
                        <input type="hidden" name="plan_price" id="plan_price" value="210" required>
					</div>
				</article>
			</section>
			<script>
				// Get all the plan CTA links
				const planCTALinks = document.querySelectorAll('.plan__cta-link');

				// Loop through each plan CTA link and add a click event listener
				planCTALinks.forEach((link) => {
					link.addEventListener('click', (event) => {
						// Prevent the default link behavior
						event.preventDefault();

						// Remove the active class from all plan items and links
						const planItems = document.querySelectorAll('.plan__item');
						const planCTALinks = document.querySelectorAll('.plan__cta-link');
						planItems.forEach((item) => {
							item.classList.remove('plan__item--active');
						});
						planCTALinks.forEach((link) => {
							link.classList.remove('plan__cta-link--active');
						});

						// Add the active class to the clicked plan item and link
						const planItem = event.target.closest('.plan__item');
						const planCTALink = event.target.closest('.plan__cta-link');
						planItem.classList.add('plan__item--active');
						planCTALink.classList.add('plan__cta-link--active');

						// Get the price from the data attribute of the clicked link
						const price = planCTALink.dataset.price;

						// Set the value of the hidden input field to the selected plan's price
						const hiddenInput = document.getElementById('plan_price');
						hiddenInput.value = price;

						// name: plan_price
					});
				});
			</script>
            <hr>
        </div>
        <input type="button" name="previous" class="previous action-button" value="Dashboard" onclick="window.location.href='index.php'"/>
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <?php
            $query = "SELECT DATE(appointment) AS appointment_date, COUNT(*) AS appointment_count FROM appointment_tb GROUP BY appointment_date";
            $result = $conn->query($query);
            $disabledDates = array();
            while ($row = $result->fetch_assoc()) {
                if ($row['appointment_count'] >= 25) {
                    $disabledDates[] = $row['appointment_date'];
                }
            }
            $disabledDatesJson = json_encode($disabledDates);
        ?>
        <h2 class="fs-title">This is step 2</h2>
        <h3 class="fs-subtitle">Select appointment date</h3>
        
		<label for="date-input">Select a date:</label>
		<input type="date" id="date-input" min="<?php echo date('Y-m-d'); ?>" name="date" required>
		<script>
		const disabledDates = <?php echo $disabledDatesJson; ?>;
		const dateInput = document.getElementById('date-input');
		dateInput.addEventListener('change', (event) => {
			if (disabledDates.includes(event.target.value)) {
			event.target.value = '';
			alert('This date is fully booked.');
			}
		});
		dateInput.addEventListener('focus', () => {
			disabledDates.forEach((date) => {
			const option = document.querySelector(`option[value="${date}"]`);
			if (option) {
				option.disabled = true;
			}
			});
		});
		</script>

        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">This is step 3</h2>
        <h3 class="fs-subtitle">Confirm Personal Details</h3>
        <input type="number" name="kilo" placeholder="Number of Kilo" onkeyup="computeTotal(event)" required/>
        <input type="number" name="total" placeholder="Total Amount to Pay" required readonly />
        <script>
            function computeTotal(e){
                var kilo = document.getElementsByName("kilo")[0].value;
                var total = (((kilo-(kilo%8))/8) * document.getElementsByName("plan_price")[0].value);
                if(total == 0){
                    total = document.getElementsByName("plan_price")[0].value;
                }
                document.getElementsByName('total')[0].value = total;
            }
        </script>
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">This is step 4</h2>
        <h3 class="fs-subtitle">Confirm Personal Details</h3>
        <input type="text" name="fname" placeholder="First Name" value="<?php echo $_SESSION['fname']; ?>" required/>
        <input type="text" name="lname" placeholder="Last Name" value="<?php echo $_SESSION['lname']; ?>" required/>
        <input type="text" name="phone" placeholder="Phone" value="<?php echo $_SESSION['phone']; ?>" required/>
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
	<fieldset>
        <h2 class="fs-title">This is step 5</h2>
        <h3 class="fs-subtitle">Choose Payment</h3>
        <select name="payment" required>
            <option value="" disabled selected>Select your option</option>
			<option value="remote">Card/ePayment</option>
		</select>
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="submit" name="saveOrder" class="next action-button" value="Submit" />
    </fieldset>
    </form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/calendar-script.js"></script>
<script src="js/schedulebooking-script.js"></script>
</html>