<div>
    <style scoped>

        a {
        text-decoration: none;
        color: #000000;
        }

        a:hover {
        color: #222222
        }

        /* Dropdown */

        .dropdown {
        display: inline-block;
        z-index: 100;
        }

        .dd-button {
        display: inline-block;
        border: none;
        padding: 10px 30px 10px 20px;
        background-color: inherit;
        cursor: pointer;
        white-space: nowrap;
        }

        .dd-button:after {
        content: '';
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        width: 0; 
        height: 0; 
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid black;
        }

        .dd-input {
        display: none;
        }

        .dd-menu {
        position: absolute;
        top: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 0;
        margin: 2px 0 0 0;
        box-shadow: 0 0 6px 0 rgba(0,0,0,0.1);
        background-color: #ffffff;
        list-style-type: none;
        }

        .dd-input + .dd-menu {
        display: none;
        } 

        .dd-input:checked + .dd-menu {
        display: block;
        } 

        .dd-menu li {
        padding: 10px 20px;
        cursor: pointer;
        white-space: nowrap;
        }

        .dd-menu li:hover {
        background-color: #f6f6f6;
        }

        .dd-menu li a {
        display: block;
        margin: -10px -20px;
        padding: 10px 20px;
        }

        .dd-menu li.divider{
        padding: 0;
        border-bottom: 1px solid #cccccc;
        }
    </style>
    <div class="app-header">
        <div class="app-header-left">
            <span class="app-icon"></span>
            <p class="app-name"><?php echo $__title; ?></p>
            <!-- Search Here. In case ibalik -->
        </div>
        <div class="app-header-right">
            <button class="mode-switch" title="Switch Theme">
                <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                    <defs></defs>
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
            </button>
            <button class="profile-btn mode-switch">
                <img src="account_information/<?php echo $_SESSION['id']; ?>/dp.png?<?php echo time(); ?>" />
                <label class="dropdown">
                    <div class="dd-button">
                        <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>
                    </div>
                    <input type="checkbox" class="dd-input" id="test">
                    <ul class="dd-menu">
                        <li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
                        <li><a href="setting.php"><i class="fa fa-cog"></i> Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="auth.php?signout=<?php echo $_SESSION['id'];?>"><i class="fa fa-reply"></i> Logout</a></li>
                    </ul>
                </label>
            </button>
        </div>
    </div>
</div>
