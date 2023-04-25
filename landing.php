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
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home | Wash It Yourself Laundry Hub</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap">
    <link rel="stylesheet" href="css/landing-style.css">
</head>

<body>
    <div id="page" class="site">
        <header class="site-header">
            <div class="site-header-main">
                <div class="site-branding">
                    <img src="https://scontent.fmnl30-3.fna.fbcdn.net/v/t1.15752-9/335754894_6241461065899241_1804965744318775672_n.png?_nc_cat=108&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeEj-J4U2H-dfD4FVdePcYSkIMLrWTGMImUgwutZMYwiZQ79h2kW5mi9V3N_tcOwxj9Wz7wUaXgcQg7nvHXoSOOi&_nc_ohc=l_XymMQCqAEAX9x-WX3&_nc_ht=scontent.fmnl30-3.fna&oh=03_AdRpaxago4kwEk05I9o_9Qbj_vObmBwPBaFfPPn7kgy03w&oe=643A1BB1" width="50" />
                    <h1 class="site-title">Wash It Yourself</h1>
                    <p class="site-description">Laundry Hub</p>
                </div>
                <nav class="site-navigation">
                    <ul>
                        <li><a href="#functions">Service</a></li>
                        <li><a href="#team">Staff</a></li>
                        <li><a href="#diff">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <?php if(isset($_SESSION['logged_status'])){ ?>
                            <li><a href="index.php">Dashboard</a></li>
                        <?php }else{ ?>
                            <li><a href="register.php">Register</a></li>
                            <li><a href="auth.php">Login</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </header>

        <main class="site-content">
            <ul class="hero">
                <li class="hero-slide style-5">
                    <h2>We make laundry day a breeze!</h2>
                    <p>The hub for clean clothes</p>
                    <div class="cta">
                        <?php if(isset($_SESSION['logged_status'])){ ?>
                            <a href="schedulebooking.php"
                                target="_blank" class="button dark">Start Laundying</a>
                        <?php }else{ ?>
                            <a href="auth.php"
                                target="_blank" class="button dark">Start Laundying</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
            <div class="functions" id="functions">
                <h2 class="section-title">The Service</h2>
                <div class="item">
                    <figure>
                        <img src="https://www.yourhomeandgarden.co.nz/wp-content/uploads/2021/09/yhg_reno_laundry.jpg">
                    </figure>
                    <div class="description">
                        <h3><span>Our</span>Mission</h3>
                        <p>Our mission at Wash It Yourself Laundry Hub is to provide a clean, convenient, and affordable self-service laundry
                        experience to our customers. We strive to create a welcoming and safe environment where customers can feel comfortable
                        washing and drying their clothes while enjoying excellent customer service.</p>
                    </div>
                </div>

                <div class="item">
                    <figure>
                        <img src="https://static.vecteezy.com/system/resources/previews/006/764/971/original/graphic-of-national-laundry-day-good-for-national-laundry-day-celebration-flat-design-flyer-design-flat-illustration-free-vector.jpg">
                    </figure>
                    <div class="description">
                        <h3><span>Our</span> Vision</h3>
                        <p>At Wash It Yourself Laundry Hub, we envision a community where everyone has access to a reliable and efficient laundry
                        facility. We believe that by providing exceptional customer service and modern equipment, we can make a positive impact
                        on the lives of our customers. Our goal is to become the go-to laundry hub for individuals and families who value
                        quality, convenience, and affordability.</p>
                    </div>
                </div>
            </div>

            <div id="team">
                <style scoped>
                    article h1 {
                    font-weight: 900;
                    font-size: 2.7rem;
                    max-width: 20ch;
                    }

                    article p {
                    max-width: 100%;
                    }

                    article a {
                    color: currentcolor;
                    }

                    /* Utilities */
                    .auto-grid {
                    display: grid;
                    grid-template-columns: repeat(
                        auto-fill,
                        minmax(var(--auto-grid-min-size, 14rem), 1fr)
                    );
                    grid-gap: var(--auto-grid-gap, 0);
                    padding: 0;
                    }

                    .flow > * + * {
                    margin-top: var(--flow-space, 1em);
                    }

                    /* Composition */
                    .team {
                    --flow-space: 2em;
                    }

                    /* Blocks */
                    .profile {
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    aspect-ratio: 1/1;
                    position: relative;
                    padding: 1.5rem;
                    color: #ffffff;
                    backface-visibility: hidden;
                    text-decoration: none;
                    overflow: hidden;
                    }

                    .profile::before,
                    .profile::after {
                    content: "";
                    width: 100%;
                    height: 100%;
                    position: absolute;
                    /*inset: 0;*/
                    top: 0;
                    left: 0;
                    }

                    .profile::before {
                    background: linear-gradient(
                        to top,
                        hsl(0 0% 0% / 0.79) 0%,
                        hsl(0 0% 0% / 0.787) 7.8%,
                        hsl(0 0% 0% / 0.779) 14.4%,
                        hsl(0 0% 0% / 0.765) 20.2%,
                        hsl(0 0% 0% / 0.744) 25.3%,
                        hsl(0 0% 0% / 0.717) 29.9%,
                        hsl(0 0% 0% / 0.683) 34.3%,
                        hsl(0 0% 0% / 0.641) 38.7%,
                        hsl(0 0% 0% / 0.592) 43.3%,
                        hsl(0 0% 0% / 0.534) 48.4%,
                        hsl(0 0% 0% / 0.468) 54.1%,
                        hsl(0 0% 0% / 0.393) 60.6%,
                        hsl(0 0% 0% / 0.31) 68.3%,
                        hsl(0 0% 0% / 0.216) 77.3%,
                        hsl(0 0% 0% / 0.113) 87.7%,
                        hsl(0 0% 0% / 0) 100%
                    );
                    transition: 300ms opacity linear;
                    }

                    .profile::after {
                    background: linear-gradient(
                        45deg,
                        hsl(5 97% 63% / 0.7) 0,
                        hsl(5 97% 63% / 0) 100%
                    );
                    opacity: 0;
                    transition: 300ms opacity linear;
                    }

                    .profile > * {
                    z-index: 1;
                    }

                    .profile img {
                    width: 100%;
                    height: 100%;
                    position: absolute;
                    top: 0;
                    left: 0;
                    margin: 0;
                    z-index: -1;
                    object-fit: cover;
                    filter: grayscale(1);
                    transition: filter 200ms ease, transform 250ms linear;
                    }

                    .profile h2,
                    .profile p {
                    transform: translateY(2ex);
                    }

                    .profile h2 {
                    font-size: 1.7rem;
                    line-height: 1.2;
                    font-weight: 900;
                    letter-spacing: 0.03ch;
                    transition: 300ms transform ease;
                    }

                    .profile p {
                    font-size: 1.2rem;
                    font-weight: 500;
                    }

                    .profile p {
                    opacity: 0;
                    transition: 300ms opacity linear, 300ms transform ease-in-out;
                    }

                    .profile:focus {
                    outline: 0.5rem solid white;
                    outline-offset: -0.5rem;
                    }

                    .profile:hover :is(h2, p),
                    .profile:focus :is(h2, p) {
                    transform: none;
                    }

                    .profile:hover::after,
                    .profile:focus::after,
                    .profile:hover::before,
                    .profile:focus::before {
                    opacity: 0.7;
                    }

                    .profile:hover p,
                    .profile:focus p {
                    opacity: 1;
                    transition-delay: 200ms;
                    }

                    .profile:hover img,
                    .profile:focus img {
                    filter: grayscale(0);
                    transform: scale(1.05) rotate(1deg);
                    }
                    .profile__name, .profile__position {
                        color: white;
                    }
                    .profile__name:hover, .profile__position:hover {
                        color: white;
                    }
                </style>
                <article class="flow">
                <h1>Our Team</h1>
                <p>The Wash It Yourself Laundry Hub's dev team is a group of talented and passionate individuals who work tirelessly to improve and innovate our laundry service platform. With their diverse skills and expertise, they have successfully developed and maintained a user-friendly app that streamlines laundry services for our customers. Their dedication to providing excellent customer experience is what sets our laundry service apart from the rest.</p>
                <div class="team">
                    <ul class="auto-grid" role="list">
                    <li>
                        <a href="#" target=_blank" class="profile">
                        <h2 class="profile__name">John Lloyd Milan</h2>
                        <p class="profile__position">Technical Lead/CTO</p>
                        <img alt="John Lloyd Milan" src="asset/img/milan.jpg" />
                        </a>
                    </li>
                    <li>
                        <a href="#" target=_blank" class="profile">
                        <h2 class="profile__name">Jhon Rex Caballes</h2>
                        <p class="profile__position">Web Designer</p>
                        <img alt="Profile shot for Jhon Rex Caballes" src="asset/img/caballes.jpg" />
                        </a>
                    </li>
                    <li>
                        <a href="#" target=_blank" class="profile">
                        <h2 class="profile__name">Michael Orogo</h2>
                        <p class="profile__position">Quality Analyst</p>
                        <img alt="Profile shot for Michael Orogo" src="asset/img/orogo.jpg" />
                        </a>
                    </li>
                    <li>
                        <a href="#" target=_blank" class="profile">
                        <h2 class="profile__name">Renzo Yutuc</h2>
                        <p class="profile__position">Database Manager</p>
                        <img alt="Profile shot for Renzo Yutuc" src="asset/img/yutuc.jpg" />
                        </a>
                    </li>
                    <li>
                        <a href="#" target=_blank" class="profile">
                        <h2 class="profile__name">John Alfred Ligutan</h2>
                        <p class="profile__position">Infrastructure Engineer</p>
                        <img alt="Profile shot for John Alfred Ligutan" src="asset/img/ligutan.jpg" />
                        </a>
                    </li>
                    </ul>
                </div>
                </article>
            </div>

            <div class="stats section">
                <ul class="stats-listing">
                    <li><span class="count">25</span> Laundry/Day</li>
                    <li><span class="count">7</span> Staffs</li>
                    <li><span class="count">5</span> IT Professionals</li>
                </ul>
            </div>

            <div class="diff" id="diff">
                <h2 class="section-title">What's So Different?</h2>
                <div class="item">
                </div>
                <div class="text-content full-width-content">
                    <p>In today's fast-paced world, time is a precious commodity. With a million things to do and places to be, laundry can often feel like a daunting task that gets pushed to the bottom of the to-do list. But what if we told you that laundry doesn't have to be a chore anymore? That's where Wash It Yourself comes in. </p>

                    <p>At Wash It Yourself, we believe that doing laundry should be easy, convenient, and stress-free. That's why we've created an online appointment setter with email and payment gateway functions, allowing you to book your laundry appointments with just a few clicks of a button. No more waiting in long lines at the laundromat or wasting time on a trip to the dry cleaner. With Wash It Yourself, you can schedule your laundry appointments at a time and place that suits you.</p>

                    <p>But what sets Wash It Yourself apart from other laundry services? For starters, we're not just a laundry service. We're a technology company that's dedicated to making your life easier. Our user-friendly platform is designed to streamline the laundry process, saving you time and hassle. And because our platform is constantly evolving, we're always finding new ways to improve and enhance the Wash It Yourself experience.</p>

                    <p>But that's not all. At Wash It Yourself, we're committed to sustainability and eco-friendliness. That's why we use only the highest quality, eco-friendly products and practices. Our state-of-the-art machines and expert technicians ensure that your laundry is done to perfection every time, while minimizing our environmental impact.</p>

                    <p>So why choose Wash It Yourself? Because we're not just a laundry service – we're a lifestyle. We believe in making things easy, convenient, and stress-free. We believe in sustainability and eco-friendliness. And most importantly, we believe in you. With Wash It Yourself, you can take back your time and enjoy the things that matter most. Try us out today and see the difference for yourself.</p>

        </main>
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
                <header class="pricing__header">
                    <h1 class="pricing__title" style="font-size:20x;">Service Plan</h1>
                </header>
                <article class="plans">
                    <div class="plans__list">
                        <article class="plan__item">
                            <div class="plan__header">
                                <h2 class="plan__title">Self Service</h2>
                                <h1 class="plan__price">180</h1>
                            </div>
                            <a href="schedulebooking.php" class="plan__cta-link ">Get Started</a>
                        </article>
                        <article class="plan__item plan__item--active">
                            <div class="plan__header">
                                <h2 class="plan__title">Full Service</h2>
                                <h1 class="plan__price">210</h1>
                            </div>
                            <a href="schedulebooking.php" class="plan__cta-link plan__cta-link--active">Get Started</a>
                        </article>
                    </div>
            </section>
            <hr>
        </div>
        <footer class="site-footer">
            <div class="contact">
                <h2 class="section-title">we wanna hear what you think!</h2>

                <div class="contact-info">
                    <div class="contact-details">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Unit 11 G/F Alicante Building Marquinton Residences Toyota Avenue corner Cirma Street Brgy. Sto. Niño, Marikina City,
                        Philippines </p>
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> <a
                                href="WashitYourselfLaundryHub@gmail.com">WashitYourselfLaundryHub@gmail.com</a></p>
                        <ul class="social-media">
                            <li><a href="https://www.facebook.com/WashItYourself"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-github-alt fa-lg" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="contact-form">
                        <form id="contact" method="POST" action="https://formspree.io/cocoricobot@gmail.com">
                            <p>
                                <input type="text" name="name" id="name" placeholder="name" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>" required>
                            </p>
                            <p>
                                <input type="email" name="email" id="email" placeholder="email" value="<?php echo $_SESSION['email']; ?>" required>
                            </p>
                            <p>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="your message"
                                    required></textarea>
                            </p>
                            <p>
                                <input type="hidden" name="_subject" value="Contact Form Submission" />
                                <input type="submit" value="submit" class="button light">
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <img src="https://scontent.fmnl30-3.fna.fbcdn.net/v/t1.15752-9/335754894_6241461065899241_1804965744318775672_n.png?_nc_cat=108&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeEj-J4U2H-dfD4FVdePcYSkIMLrWTGMImUgwutZMYwiZQ79h2kW5mi9V3N_tcOwxj9Wz7wUaXgcQg7nvHXoSOOi&_nc_ohc=l_XymMQCqAEAX9x-WX3&_nc_ht=scontent.fmnl30-3.fna&oh=03_AdRpaxago4kwEk05I9o_9Qbj_vObmBwPBaFfPPn7kgy03w&oe=643A1BB1" width="45" />
                <div>
                    <div />
                    <p>&copy; 2023 Wash It Yourself</p>
                    <p>All Rights Reserved</p>
                </div>
        </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/landing-script.js"></script>
</body>
</html>