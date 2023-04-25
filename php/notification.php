<?php 
    function notification($id, $name, $message) {
?>
<div>
    <style scoped>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600');
        .custom-social-proof {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 9999999999999 !important;
            font-family: 'Open Sans', sans-serif;
        }
        .custom-social-proof .custom-notification {
            width: 320px;
            border: 0;
            text-align: left;
            z-index: 99999;
            box-sizing: border-box;
            font-weight: 400;
            border-radius: 6px;
            box-shadow: 2px 2px 10px 2px rgba(11, 10, 10, 0.2);
            background-color: #fff;
            position: relative;
            cursor: pointer;
        }
        .custom-social-proof .custom-notification .custom-notification-container {
            display: flex !important;
            align-items: center;
            height: 80px;
        }
        .custom-social-proof .custom-notification .custom-notification-container .custom-notification-image-wrapper img {
            max-height: 75px;
            width: 90px;
            overflow: hidden;
            border-radius: 6px 0 0 6px;
            object-fit: contain;
        }
        .custom-social-proof .custom-notification .custom-notification-container .custom-notification-content-wrapper {
            margin: 0;
            height: 100%;
            color: gray;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 0 6px 6px 0;
            flex: 1;
            display: flex !important;
            flex-direction: column;
            justify-content: center;
        }
        .custom-social-proof .custom-notification .custom-notification-container .custom-notification-content-wrapper .custom-notification-content {
            font-family: inherit !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 14px;
            line-height: 16px;
        }
        .custom-social-proof .custom-notification .custom-notification-container .custom-notification-content-wrapper .custom-notification-content small {
            margin-top: 3px !important;
            display: block !important;
            font-size: 12px !important;
            opacity: 0.8;
        }
        .custom-social-proof .custom-notification .custom-close {
            position: absolute;
            top: 8px;
            right: 8px;
            height: 12px;
            width: 12px;
            cursor: pointer;
            transition: 0.2s ease-in-out;
            transform: rotate(45deg);
            opacity: 0;
        }
        .custom-social-proof .custom-notification .custom-close::before {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            background-color: gray;
            position: absolute;
            left: 0;
            top: 5px;
        }
        .custom-social-proof .custom-notification .custom-close::after {
            content: "";
            display: block;
            height: 100%;
            width: 2px;
            background-color: gray;
            position: absolute;
            left: 5px;
            top: 0;
        }
        .custom-social-proof .custom-notification:hover .custom-close {
            opacity: 1;
        }
    </style>
    <section class="custom-social-proof">
        <div class="custom-notification">
        <div class="custom-notification-container">
            <div class="custom-notification-image-wrapper">
            <img src="account_information/<?php echo $id; ?>/dp.png?<?php echo time(); ?>" style="border-radius: 50%;width:50px;height:50px;margin-left:15px;">
            </div>
            <div class="custom-notification-content-wrapper">
            <p class="custom-notification-content">
                <b><?php echo $name; ?></b><br><?php echo $message; ?>   
                <small>1 second ago</small>
            </p>
            </div>
        </div>
        <div class="custom-close"></div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(".custom-close").click(function() {
            $(".custom-social-proof").stop().slideToggle('slow');
        });
    </script>

</div>
<?php 
    }
?>