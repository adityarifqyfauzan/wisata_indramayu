<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url() ?>/general_assets/img/logoc.png" type="image/png">
    <title>Ctara Website</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/vendors/nice-select/css/nice-select.css">
    <!-- main css -->
    <link rel="stylesheet" href="<?= base_url() ?>/general_assets/css/style.css">

    <style>
        df-messenger {
            --df-messenger-chat-background-color: #fafafa;
            --df-messenger-send-icon: #878fac;
        }

        .open-button {

            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: -130px;
            width: 280px;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width textarea */
        .form-container textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            resize: none;
            min-height: 200px;
        }

        /* When the textarea gets focus, do something */
        .form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .form-container .btn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
</head>

<body>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

    <!-- <div style="z-index : 101; border:0">
        <div class="row">
            <df-messenger intent="WELCOME" chat-title="WisataIndramayu" agent-id="1d2932a1-78c6-4afa-8907-8032a4e3f849" language-code="id" chat-icon="<?= base_url() ?>/general_assets/img/logoc.png"></df-messenger>
        </div>
    </div> -->
    <a class="open-button" onclick="openForm()" style="z-index: 100; opacity:1;"><img src="general_assets/img/logoc.png" width="40%" alt="" -webkit-filter: drop-shadow(5px 5px 5px #222222); filter: drop-shadow(5px 5px 5px #222222);></a>


    <div class="chat-popup" id="myForm" style="z-index : 101; border:0">
        <div class="row">
            <iframe allow="microphone;" width="350" height="430" src="https://console.dialogflow.com/api-client/demo/embedded/1d2932a1-78c6-4afa-8907-8032a4e3f849">
            </iframe>
        </div>
        <br><br>
        <div class="row">
            <button type="button" class="btn cancel" onclick="closeForm()" style="position: absolute;bottom: 88%;right: 0%;">Close</button>
        </div>
    </div>
    </div>


    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html" style="width: 65%"><img src="<?= base_url() ?>/general_assets/img/liza.png" width="120px" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="<?= ($page == 'home') ? "active" : "" ?> nav-item "><a class="nav-link" href="/">Home</a></li>
                            <li class="<?= ($page == "tentang") ? "active" : "" ?> nav-item"><a class="nav-link" href="/tentang">About Us</a></li>
                            <li class="nav-item submenu dropdown">
                                <ul class="dropdown-menu">
                                    <?php

                                    use phpDocumentor\Reflection\Types\This;

                                    foreach ($kategori as $kategoriName) : ?>
                                        <li class="nav-item"><a class="nav-link" href="/wisata/<?= $kategoriName['id'] ?>"><?= $kategoriName['kategori'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Wisata</a>
                            </li>

                            <li class="<?= ($page == "kontak") ? "active" : "" ?> nav-item"><a class="nav-link" href="/kontak">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>




    <?= $this->renderSection('content') ?>

    <footer class="footer-area">
        <div class="footer_top section_gap_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h5 class="footer_title">Contact</h5>
                            <p class="about-text">Email: Disbudparindramayu@gmail.com</p>
                            <p class="about-text">Phone: (0234) 272325</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h5 class="footer_title">Links</h5>
                            <div class="row">
                                <div class="col-5">
                                    <ul class="list">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Wisata</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h5>Alamat</h5>
                            <p>Jl. Gatot Subroto No.4, Karanganyar, Kec. Indramayu, Kabupaten Indramayu, Jawa Barat 45213</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | Dinas Kebudayaan dan Pariwisata Indramayu | This
                            template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 text-right">

                    </div>
                </div>
            </div>
        </div>
    </footer>
    <whatsapp></whatsapp>
    <script src="<?= base_url() ?>/general_assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/popper.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/stellar.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/owl-carousel-thumb.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="<?= base_url() ?>/general_assets/js/gmaps.min.js"></script>
    <script src="<?= base_url() ?>/general_assets/js/theme.js"></script>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+6289661043429", // WhatsApp number
                call_to_action: "Hubungi Kami", // Call to action
                position: "left", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>
    <!-- /GetButton.io widget -->

    <?= $this->renderSection('js') ?>

</body>

</html>