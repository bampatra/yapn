<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



<!------ Include the above in your HEAD tag ---------->

<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html><html class=''>
<head>

    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <title> PIRA CHAT </title>

    <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

    <script src="https://use.typekit.net/hoy3lrg.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <link href=" <?php echo base_url('assets/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap4.min.js');?>"></script>

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <style class="cp-pen-styles">
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #e4f0fd;
            font-family: "proxima-nova", "Source Sans Pro", sans-serif;
            font-size: 1em;
            letter-spacing: 0.1px;
            color: #32465a;
            text-rendering: optimizeLegibility;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
            -webkit-font-smoothing: antialiased;
        }

        #frame {
            width: 98%;
            min-width: 360px;
            max-width: 100%;
            height: 92vh;
            min-height: 300px;
            max-height: 720px;
            background: #E6EAEA;
        }
        @media screen and (max-width: 360px) {
            #frame {
                width: 100%;
                height: 100vh;
            }
        }
        #frame #sidepanel {
            float: left;
            min-width: 280px;
            max-width: 340px;
            width: 20%;
            height: 100%;
            background: #2c3e50;
            color: #f5f5f5;
            overflow: hidden;
            position: relative;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel {
                width: 58px;
                min-width: 58px;
            }
        }
        #frame #sidepanel #profile {
            width: 80%;
            margin: 25px auto;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile {
                width: 100%;
                margin: 0 auto;
                padding: 5px 0 0 0;
                background: #32465a;
            }
        }
        #frame #sidepanel #profile.expanded .wrap {
            height: 210px;
            line-height: initial;
        }
        #frame #sidepanel #profile.expanded .wrap p {
            margin-top: 20px;
        }
        #frame #sidepanel #profile.expanded .wrap i.expand-button {
            -moz-transform: scaleY(-1);
            -o-transform: scaleY(-1);
            -webkit-transform: scaleY(-1);
            transform: scaleY(-1);
            filter: FlipH;
            -ms-filter: "FlipH";
        }
        #frame #sidepanel #profile .wrap {
            height: 60px;
            line-height: 60px;
            overflow: hidden;
            -moz-transition: 0.3s height ease;
            -o-transition: 0.3s height ease;
            -webkit-transition: 0.3s height ease;
            transition: 0.3s height ease;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap {
                height: 55px;
            }
        }


        #frame #sidepanel #profile .wrap p {
            float: left;
            margin-left: 15px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap p {
                display: none;
            }
        }
        #frame #sidepanel #profile .wrap i.expand-button {
            float: right;
            margin-top: 23px;
            font-size: 0.8em;
            cursor: pointer;
            color: #435f7a;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap i.expand-button {
                display: none;
            }
        }
        #frame #sidepanel #profile .wrap #status-options {
            position: absolute;
            opacity: 0;
            visibility: hidden;
            width: 150px;
            margin: 70px 0 0 0;
            border-radius: 6px;
            z-index: 99;
            line-height: initial;
            background: #435f7a;
            -moz-transition: 0.3s all ease;
            -o-transition: 0.3s all ease;
            -webkit-transition: 0.3s all ease;
            transition: 0.3s all ease;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options {
                width: 58px;
                margin-top: 57px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options.active {
            opacity: 1;
            visibility: visible;
            margin: 75px 0 0 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options.active {
                margin-top: 62px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 8px solid #435f7a;
            margin: -8px 0 0 24px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options:before {
                margin-left: 23px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul {
            overflow: hidden;
            border-radius: 6px;
        }
        #frame #sidepanel #profile .wrap #status-options ul li {
            padding: 15px 0 30px 18px;
            display: block;
            cursor: pointer;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li {
                padding: 15px 0 35px 22px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li:hover {
            background: #496886;
        }
        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 5px 0 0 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
                width: 14px;
                height: 14px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
            content: '';
            position: absolute;
            width: 14px;
            height: 14px;
            margin: -3px 0 0 -3px;
            background: transparent;
            border-radius: 50%;
            z-index: 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
                height: 18px;
                width: 18px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li p {
            padding-left: 12px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li p {
                display: none;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-online span.status-circle {
            background: #2ecc71;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-online.active span.status-circle:before {
            border: 1px solid #2ecc71;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-away span.status-circle {
            background: #f1c40f;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-away.active span.status-circle:before {
            border: 1px solid #f1c40f;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-busy span.status-circle {
            background: #e74c3c;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-busy.active span.status-circle:before {
            border: 1px solid #e74c3c;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-offline span.status-circle {
            background: #95a5a6;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-offline.active span.status-circle:before {
            border: 1px solid #95a5a6;
        }
        #frame #sidepanel #profile .wrap #expanded {
            padding: 100px 0 0 0;
            display: block;
            line-height: initial !important;
        }
        #frame #sidepanel #profile .wrap #expanded label {
            float: left;
            clear: both;
            margin: 0 8px 5px 0;
            padding: 5px 0;
        }
        #frame #sidepanel #profile .wrap #expanded input {
            border: none;
            margin-bottom: 6px;
            background: #32465a;
            border-radius: 3px;
            color: #f5f5f5;
            padding: 7px;
            width: calc(100% - 43px);
        }
        #frame #sidepanel #profile .wrap #expanded input:focus {
            outline: none;
            background: #435f7a;
        }
        #frame #sidepanel #search {
            border-top: 1px solid #32465a;
            border-bottom: 1px solid #32465a;
            font-weight: 300;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #search {
                display: none;
            }
        }
        #frame #sidepanel #search label {
            position: absolute;
            margin: 10px 0 0 20px;
        }
        #frame #sidepanel #search input {
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
            padding: 10px 0 10px 46px;
            width: calc(100% - 25px);
            border: none;
            background: #32465a;
            color: #f5f5f5;
        }
        #frame #sidepanel #search input:focus {
            outline: none;
            background: #435f7a;
        }
        #frame #sidepanel #search input::-webkit-input-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #search input::-moz-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #search input:-ms-input-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #search input:-moz-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #contacts {
            height: calc(100% - 177px);
            overflow-y: scroll;
            overflow-x: hidden;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts {
                height: calc(100% - 149px);
                overflow-y: scroll;
                overflow-x: hidden;
            }
            #frame #sidepanel #contacts::-webkit-scrollbar {
                display: none;
            }
        }
        #frame #sidepanel #contacts.expanded {
            height: calc(100% - 334px);
        }
        #frame #sidepanel #contacts::-webkit-scrollbar {
            width: 8px;
            background: #2c3e50;
        }
        #frame #sidepanel #contacts::-webkit-scrollbar-thumb {
            background-color: #243140;
        }
        #frame #sidepanel #contacts ul li.contact {
            position: relative;
            padding: 10px 0 15px 0;
            font-size: 0.9em;
            cursor: pointer;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact {
                padding: 6px 0 46px 8px;
            }
        }
        #frame #sidepanel #contacts ul li.contact:hover {
            background: #32465a;
        }
        #frame #sidepanel #contacts ul li.contact.active {
            background: #32465a;
            border-right: 5px solid #435f7a;
        }
        #frame #sidepanel #contacts ul li.contact.active span.contact-status {
            border: 2px solid #32465a !important;
        }
        #frame #sidepanel #contacts ul li.contact .wrap {
            width: 88%;
            margin: 0 auto;
            position: relative;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap {
                width: 100%;
            }
        }
        #frame #sidepanel #contacts ul li.contact .wrap span {
            position: absolute;
            left: 0;
            margin: -2px 0 0 -2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #2c3e50;
            background: #95a5a6;
        }
        #frame #sidepanel #contacts ul li.contact .wrap span.online {
            background: #2ecc71;
        }
        #frame #sidepanel #contacts ul li.contact .wrap span.away {
            background: #f1c40f;
        }
        #frame #sidepanel #contacts ul li.contact .wrap span.busy {
            background: #e74c3c;
        }

        #frame #sidepanel #contacts ul li.contact .wrap .meta {
            padding: 5px 0 0 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap .meta {
                display: none;
            }
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta .name {
            font-weight: 600;
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
            margin: 5px 0 0 0;
            padding: 0 0 1px;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -moz-transition: 1s all ease;
            -o-transition: 1s all ease;
            -webkit-transition: 1s all ease;
            transition: 1s all ease;
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
            position: initial;
            border-radius: initial;
            background: none;
            border: none;
            padding: 0 2px 0 0;
            margin: 0 0 0 1px;
            opacity: .5;
        }
        #frame #sidepanel #bottom-bar {
            position: absolute;
            width: 100%;
            bottom: 0;
        }
        #frame #sidepanel #bottom-bar button {
            float: left;
            border: none;
            width: 50%;
            padding: 10px 0;
            background: #32465a;
            color: #f5f5f5;
            cursor: pointer;
            font-size: 0.85em;
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button {
                float: none;
                width: 100%;
                padding: 15px 0;
            }
        }
        #frame #sidepanel #bottom-bar button:focus {
            outline: none;
        }
        #frame #sidepanel #bottom-bar button:nth-child(1) {
            border-right: 1px solid #2c3e50;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button:nth-child(1) {
                border-right: none;
                border-bottom: 1px solid #2c3e50;
            }
        }
        #frame #sidepanel #bottom-bar button:hover {
            background: #435f7a;
        }
        #frame #sidepanel #bottom-bar button i {
            margin-right: 3px;
            font-size: 1em;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button i {
                font-size: 1.3em;
            }
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button span {
                display: none;
            }
        }
        #frame .content {
            float: left;
            width: 60%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }
        @media screen and (max-width: 735px) {
            #frame .content {
                width: calc(100% - 58px);
                min-width: 300px !important;
            }
        }
        @media screen and (min-width: 900px) {
            #frame .content {
                width: calc(100% - 280px);
            }
        }
        #frame .content .contact-profile {
            width: 100%;
            height: 60px;
            line-height: 60px;
            background: #f5f5f5;
        }

        #frame .content .contact-profile p {
            float: left;
        }
        #frame .content .contact-profile .social-media {
            float: right;
        }
        #frame .content .contact-profile .social-media i {
            margin-left: 14px;
            cursor: pointer;
        }
        #frame .content .contact-profile .social-media i:nth-last-child(1) {
            margin-right: 20px;
        }
        #frame .content .contact-profile .social-media i:hover {
            color: #435f7a;
        }
        #frame .content .messages {
            height: auto;
            min-height: calc(100% - 93px);
            max-height: calc(100% - 93px);
            overflow-y: scroll;
            overflow-x: hidden;
            width: 63%;
            float: left;
        }
        @media screen and (max-width: 735px) {
            #frame .content .messages {
                max-height: calc(100% - 105px);
            }
        }
        #frame .content .messages::-webkit-scrollbar {
            width: 8px;
            background: transparent;
        }
        #frame .content .messages::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
        }
        #frame .content .messages ul li {
            display: inline-block;
            clear: both;
            float: left;
            margin: 15px 15px 5px 15px;
            width: calc(100% - 25px);
            font-size: 0.9em;
        }
        #frame .content .messages ul li:nth-last-child(1) {
            margin-bottom: 20px;
        }

        #frame .content .messages ul li.sent p {
            background: #435f7a;
            color: #f5f5f5;
        }

        #frame .content .messages ul li.replies p {
            background: #f5f5f5;
            float: right;
        }

        #frame .content .messages ul li p {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 205px;
            line-height: 130%;
        }
        @media screen and (min-width: 735px) {
            #frame .content .messages ul li p {
                max-width: 300px;
            }
        }
        #frame .content .message-input {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 99;
        }
        #frame .content .message-input .wrap {
            position: relative;
        }
        #frame .content .message-input .wrap input {
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
            float: left;
            border: none;
            width: calc(100% - 90px);
            padding: 11px 32px 10px 8px;
            font-size: 0.8em;
            color: #32465a;
        }
        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap input {
                padding: 15px 32px 16px 8px;
            }
        }
        #frame .content .message-input .wrap input:focus {
            outline: none;
        }
        #frame .content .message-input .wrap .attachment {
            position: absolute;
            right: 60px;
            z-index: 4;
            margin-top: 10px;
            font-size: 1.1em;
            color: #435f7a;
            opacity: .5;
            cursor: pointer;
        }
        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap .attachment {
                margin-top: 17px;
                right: 65px;
            }
        }
        #frame .content .message-input .wrap .attachment:hover {
            opacity: 1;
        }
        #frame .content .message-input .wrap button {
            float: right;
            border: none;
            width: 50px;
            padding: 12px 0;
            cursor: pointer;
            background: #32465a;
            color: #f5f5f5;
        }
        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap button {
                padding: 16px 0;
            }
        }
        #frame .content .message-input .wrap button:hover {
            background: #435f7a;
        }
        #frame .content .message-input .wrap button:focus {
            outline: none;
        }


        #snackbar{
            visibility: hidden; /* Hidden by default. Visible on click */
            min-width: 250px; /* Set a default minimum width */
            margin-left: -125px; /* Divide value of min-width by 2 */
            background-color: #333; /* Black background color */
            color: #fff; /* White text color */
            text-align: center; /* Centered text */
            border-radius: 8px; /* Rounded borders */
            padding: 16px; /* Padding */
            position: fixed; /* Sit on top of the screen */
            z-index: 1000; /* Add a z-index if needed */
            left: 50%; /* Center the snackbar */
            bottom: 80px; /* 800px from the bottom */
            z-index: 10000;
        }

        /* Show the snackbar when clicking on a button (class added with JavaScript) */
        #snackbar.show {
            visibility: visible; /* Show the snackbar */
            /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
            However, delay the fade out process for 2.5 seconds */
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        .Veil-non-hover{
            z-index: 4998;
            background-color: rgba(34,25,36,.5);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1001;
            display: none;
        }

        .loading{
            width: 600px;
            position: fixed;
            z-index: 10000;
            display: none;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .history{
            width: 37%;
            float: right;
            height: 100%;
            position: relative;
            overflow-y: scroll;
            overflow-x: hidden;
            background: #dcdcdc;
            display: none;
        }

        .middle{
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }

        .status_order{
            width: 16%;
        }

        .status_selected{
            color: #a50000; border-bottom: 1px solid #a50000;
        }

        .status_order:hover{
            color: #a50000;
        }

        .status_table{
            width: 100%;
            height:50px;
            background: #f4f4f5;
            text-align: center;
            cursor: pointer;
            border-spacing: 10px;
            border-collapse: separate;
        }

        .status_option::-webkit-scrollbar {
            -webkit-appearance: none;
        }

        .status_option::-webkit-scrollbar:vertical {
            width: 11px;
        }

        .status_option::-webkit-scrollbar:horizontal {
            height: 11px;
        }

        .status_option::-webkit-scrollbar-thumb {
            border-radius: 8px;
            border: 2px solid #dcdcdc; /* should match background, can't be transparent */
            background-color: rgba(0, 0, 0, .5);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black !important;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #a50000; color: white !important;}

        /* Show the dropdown menu on hover */
        .history-header:hover .dropdown-content {display: block;}

    </style>
</head>

<body>

<div class="Veil-non-hover"></div>
<div id="snackbar"></div>
<img class="loading" src="<?php echo base_url('assets/images/load.gif');?>">

<div class="modal fade" tabindex="-1" role="dialog" id="master-attachment">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lampiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-primary" onclick="toggle_prod()">Lampirkan Produk</button>
                <button type="button" class="btn btn-primary" onclick="click_img()">Upload Gambar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="product-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style="max-height: 90vh; overflow: scroll;">
            <div class="modal-header">
                <h5 class="modal-title">Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTableProd" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th style="display: none;">Image</th>
                        <th style="display: none;">Warna</th>
                        <th style="display: none;">Art No.</th>
                        <th style="width: 30%"></th>
                        <th style="width: 70%">Produk</th>
                    </tr>
                    </thead>
                    <tbody id="prod-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="frame">
    <div id="sidepanel">
        <div id="search" style="text-align: center">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input id="cari_user" type="text" placeholder="Cari user..." />
            <div style="padding: 10px;">
                <select class="custom-select message_filter">
                    <option value="1">Semua</option>
                    <option value="0">Belum Dibalas</option>
                </select>
            </div>
            <i class="fa fa-plus new_chat" style="cursor: pointer; padding: 5px; margin: 5px 0;"></i>


        </div>
        <div id="contacts">
            <ul id="contacts-content">

            </ul>
        </div>
    </div>
    <div class="content">
        <img class="main_chat_logo" style="max-width: 300px;
    position: relative;
    float: left;
    top: 30%;
    left: 50%;
    transform: translate(-50%); " src="<?php echo base_url('assets/images/logo/chat.png')?>">
        <div class="contact-profile">
            <p style="margin-left: 20px;" class="current-user">Selamat Datang di Fitur Chat PIRA</p>
        </div>
        <div class="messages">
            <ul id="messages-content">
            </ul>
        </div>
        <div class="history">
            <div class="history-header" style="background: #2c3e50; text-align: center; width: 100%; padding: 15px; color: white;">
                PESANAN <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a onclick="toggle_prod()">PRODUK</a>
                </div>
            </div>
            <div class="status_option" style="overflow-x: scroll">
                <table class="status_table"><tr>
                        <td class="status_order status_selected" id="status_all"> Semua </td>
                        <td class="status_order" id="status_1"> Diterima </td>
                        <td class="status_order" id="status_2"> Diproses </td>
                        <td class="status_order" id="status_3"> Dikirim </td>
                        <td class="status_order" id="status_4"> Selesai </td>
                        <td class="status_order" id="status_5"> Dibatalkan </td>
                    </tr></table>
            </div>
            <div id="history-content" style="padding: 5px; overflow: scroll; max-height: 60vh;">
               <p class="middle"> <img style="max-width: 300px; max-height: 300px;" class="loading-history" src="<?php echo base_url('assets/images/load.gif');?>"></p>

            </div>
        </div>

        <div class="message-input" style="visibility: hidden;">
            <div class="attachment-product-view" style="padding: 15px 5px; background: white; width: 63%; border-bottom: 1px solid lightgrey; display: none">

            </div>
            <form id="chat-form">
                <div class="wrap">
                    <input type="hidden" class="id_web_user_chat" name="id_web_user_chat" value="0">
                    <input type="text" class="chat_input" name="message_chat" placeholder="...">
                    <input type="hidden" class="ref_input" name="ref_chat" value="0">
                    <input type="file" accept="image/*" class="img_input" name="img_chat" value="" style="display: none">
                    <input type="hidden" class="product_input" name="product_chat" value="0">

                    <div class="attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></div>
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="user-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style="max-height: 90vh; overflow: scroll;">
            <div class="modal-header">
                <h5 class="modal-title">User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th> User </th>
                    </tr>
                    </thead>
                    <tbody id="user-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    a:hover{
        text-decoration: none;
        color: inherit;
    }

    .notifDot{
        height: 10px;
        width: 10px;
        background-color: red !important;
        border-radius: 50%;
        display: block;
        float: left;
        position: inherit !important;
    }

    .mark_as_unread{
        position: fixed;
        left:250px;
        padding: 10px 5px;
        background-color: white;
        color: black;
        font-size: 12px;
        z-index: 1000;
        display: none;
    }

    .mark_as_unread:hover{
        cursor: pointer;
        color: white;
        background-color: #a50000;
    }
</style>
<script>
    admin_url = '<?php echo base_url('admin/');?>';
    current_user = 0;
    status = 'all';
    allow_send = true;
    user_search = '';
    message_filter = '1';
    read_all = true;

    messages = [];

    $('.message_filter').change(function(e){
        message_filter = $(this).val();
        get_message_header()
    })

    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });

    $(".expand-button").click(function() {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });

    $('.attachment').click(function(e){
        e.preventDefault();
        $('#master-attachment').modal('show');
    })

    function click_img(){
        $('#master-attachment').modal('hide');
        $('.img_input').click();
    }

    $('.status_order').click(function(){

        $('#history-content').html('<p class="middle"> <img style="max-width: 300px; max-height: 300px;" class="loading-history" src="<?php echo base_url('assets/images/load.gif');?>"></p>');
        $('.status_order').removeClass('status_selected');
        $(this).addClass('status_selected');

        status = $(this).attr('id').split('status_')[1];
        get_all_orders(current_user);
    })


    //get all products
    function get_all_orders(current_user, order = null){

        let prev = 0;

        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_orders', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {status: status, user: current_user, with_product: 'true', order: order},
            success     : function(data){

                length = data.length;

                if(data.length === 0){
                     html = '<p class="middle"> Tidak ada pesanan </p>';
                } else {
                    html = '';
                    first = true;

                    data.forEach(function(data, i){

                        if(data.id_web_so_m != prev && first == false){
                            html += '             <div style="border-bottom: 1px solid lightgrey; margin: 10px 0; width: 100%"></div>\n' +
                                '                    <div style="text-align: right; ">\n' +
                                '                        <button class="btn attach_order" style="padding: 5; font-size: 13px;" id="'+ data.id_web_so_m +'"> Kirim </button>\n' +
                                '                    </div>\n' +
                                '\n' +
                                '                </div></div><br>';
                        }


                        if(data.id_web_so_m != prev){
                            html += '<div style="width: 100%; background: white; padding: 10px;">\n' +
                                '                    <table style="width: 100%">\n' +
                                '                        <tr>\n' +
                                '                            <td style="width: 50%">\n' +
                                '                                <span style="font-size: 14px;">'+ data.bukti_web_so_m +'</span><br>\n' +
                                '                                <div style="font-size:12px; margin-top: 5px;">'+ status_pesanan(data.status_web_so_m, data.paid_by_user) +'</div>\n' +
                                '                            </td>\n' +
                                '                            <td style="width: 50%; text-align: right" valign="top">\n' +
                                '                                <div style="font-size:12px; color: darkgrey;">'+ data.tgl_web_so_m +'</div>\n' +
                                '                            </td>\n' +
                                '                        </tr>\n' +
                                '                    </table>\n' +
                                '                    <div style="border-bottom: 1px solid lightgrey; margin: 10px 0; width: 100%"></div>\n';
                        }

                        html +=    '              <table style="margin-bottom: 10px;">\n' +
                            '                        <tr>\n' +
                            '                            <td style="width: 15%">\n' +
                            '                                <img style="max-width: 50px; max-height: 50px;" src="<?php echo base_url()?>'+ data.file_web_image +'">\n' +
                            '                            </td>\n' +
                            '                            <td style="width: 2%"></td>\n' +
                            '                            <td style="width: 50%; font-size: 13px; vertical-align: top;" >'+ data.nama_product_so_d +'</td>\n' +
                            '                            <td style="width: 2%"></td>\n' +
                            '                            <td style="width: 31%; font-size: 13px; text-align: right; vertical-align: top" >'+ convertToRupiah(data.total_price_so_d) +'</td>\n' +
                            '                        </tr>\n' +
                            '                    </table>\n';



                        if(i == (length-1)){
                            html += '             <div style="border-bottom: 1px solid lightgrey; margin: 10px 0; width: 100%"></div>\n' +
                                '                    <div style="text-align: right; ">\n' +
                                '                        <button class="btn attach_order" style="padding: 5; font-size: 13px;" id="'+ data.id_web_so_m +'"> Kirim </button>\n' +
                                '                    </div>\n' +
                                '\n' +
                                '                </div><br>';
                        }


                        prev = data.id_web_so_m;
                        first = false;
                    })
                }

                $('#history-content').html(html);


                $('.attach_order').click(function(e){
                    $('.loading').css("display", "block");
                    $('.Veil-non-hover').fadeIn();

                    e.preventDefault();
                    id_web_so_m = $(this).attr('id');


                    $.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: admin_url + 'send_order_via_chat', // the url where we want to POST// our data object
                        dataType: 'json',
                        data: $('#chat-form').serialize() + "&id_web_so_m=" + id_web_so_m,
                        success: function (response) {
                            $('.loading').css("display", "none");
                            $('.Veil-non-hover').fadeOut();
                        }
                    })
                });

            }
        })
    }

    function toggle_prod(){
        $('#master-attachment').modal('hide');
        $('#product-modal').modal('toggle');
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_all_products_with_price', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '';
                data.forEach(function(data){

                    html += '<tr style="cursor: pointer;">' +
                        ' <td style="display: none;">'+ data.ucode_web_product +'</td>'+
                        ' <td style="display: none;">'+ data.file_web_image +'</td>'+
                        ' <td style="display: none;">'+ data.nama_web_col +'</td>'+
                        ' <td style="display: none;">'+ data.art_number_web_product +'</td>' +
                        '<td><img style="max-height: 100px; max-width: 100px;" src="<?php echo base_url()?>'+ data.file_web_image +'"></td>'+
                        '                      <td>'+ data.nama_web_product +'</td>' +
                        '</tr>';
                })

                $('#dataTableProd').DataTable().destroy();
                $('#prod-content').html(html);
                $('#dataTableProd').DataTable();
                $('.modal-dialog').scrollTop(0);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('#dataTableProd').on( 'click', 'tbody tr', function () {

        console.log($('#dataTableProd').DataTable().row( this ).data());

        ucode_web_product = $('#dataTableProd').DataTable().row( this ).data()[0];
        file_web_image = $('#dataTableProd').DataTable().row( this ).data()[1];
        nama_web_col = $('#dataTableProd').DataTable().row( this ).data()[2];
        art_number_web_product = $('#dataTableProd').DataTable().row( this ).data()[3];
        nama_web_product = $('#dataTableProd').DataTable().row( this ).data()[5];

        html = '<table style="width: 100%">\n'+
'                    <tr>\n'+
'                        <td style="width: 15%; text-align: center;">\n'+
'                            <img style="max-width: 50px" src="'+ file_web_image +'" >\n'+
'                        </td>\n'+
'                        <td style="width: 80%; text-align: left; font-size: 16px; vertical-align: middle" class="product_attachment_name">'+ nama_web_product +'</td>\n'+
'                        <td style="width: 5%; text-align: right; cursor: pointer; vertical-align: top;" class="remove_attachment"> <i class="fa fa-times"></i> </td>\n'+
'                    </tr>\n'+
'                </table>';


        $('.product_input').val(ucode_web_product);
        $('.attachment-product-view').html(html);
        $('.attachment-product-view').css('display', 'block');
        $('#product-modal').modal('hide');

        $('.remove_attachment').click(function(e){
            e.preventDefault();
            $('.attachment-product-view').css('display', 'none');
            $('.product_input').val(0);
        })
    } );

    $('.img_input').change(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        e.preventDefault();
        var formData = new FormData($('form')[0]);

        $.ajax({
            url         : admin_url + 'upload_image_chat',
            method      : "POST",
            data        : formData,
            processData : false,
            contentType : false,
            dataType    : 'json',
            success: function(response){
                if(response.Status == "OK"){
                    // messages.push(response.ID);
                    // $('<li class="sent"><img style="    max-width: 200px; max-height: 300px; float:left;" src="' + response.File + '"></li>').appendTo($('.messages ul'));
                    $('.message-input').val(null);

                    // get_message_detail(current_user);
                    // get_message_header();

                    // reset form
                    $('#chat-form').trigger("reset");
                    $('.attachment-product-view').css('display', 'none');
                    $('.product_input').val(0);


                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
                $('#chat-form').trigger("reset");

            }
        });
    })

    $("#status-options ul li").click(function() {
        $("#profile-img").removeClass();
        $("#status-online").removeClass("active");
        $("#status-away").removeClass("active");
        $("#status-busy").removeClass("active");
        $("#status-offline").removeClass("active");
        $(this).addClass("active");

        if($("#status-online").hasClass("active")) {
            $("#profile-img").addClass("online");
        } else if ($("#status-away").hasClass("active")) {
            $("#profile-img").addClass("away");
        } else if ($("#status-busy").hasClass("active")) {
            $("#profile-img").addClass("busy");
        } else if ($("#status-offline").hasClass("active")) {
            $("#profile-img").addClass("offline");
        } else {
            $("#profile-img").removeClass();
        };

        $("#status-options").removeClass("active");
    });

    function newMessage() {
        message = $(".chat_input").val();
        if($.trim(message) == '') {
            return false;
        }

        if(allow_send){
            allow_send = false;
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'send_chat', // the url where we want to POST
                data: $('#chat-form').serialize(), // our data object
                dataType: 'json',
                success: function (response) {
                    if(response.Status == "OK"){
                        messages = [];
                        // $('<li class="sent"><p>' + message + '</p></li>').appendTo($('.messages ul'));
                        // $('.message-input input').val(null);
                        // $('.contact.active .preview').html('<span>You: </span>' + message);
                        // $(".messages").animate({ scrollTop: $(document).height() }, "fast");


                        get_message_detail(current_user);
                        get_message_header();

                        // reset form
                        $('#chat-form').trigger("reset");
                        $('.attachment-product-view').css('display', 'none');
                        $('.product_input').val(0);
                        allow_send = true;

                    }

                }
            })
        }


    };

    $('.submit').click(function(e) {
        e.preventDefault();
        newMessage();
    });

    $(window).on('keydown', function(e) {
        if (e.which == 13) {
            newMessage();
            return false;
        }
    });

    setInterval(function(){
        get_message_header();
        get_message_detail(current_user, false);
    }, 5000);

    $(window).scroll(function() {
        if(checkVisible(document.getElementById('top-content'))){
            // loadmore();
            // console.log('loadmore');
        }
    });


    $('#cari_user').keyup(function(e){
        user_search = $(this).val();
        get_message_header();
    })

    $('.new_chat').click(function(e){
        e.preventDefault();
        toggle_user();
    })

    function toggle_user(){
        $('#user-modal').modal('toggle');
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_users_except', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {
                html = '';
                data.forEach(function(data){

                    html += '<tr style="cursor: pointer;">' +
                        ' <td style="display: none;">'+ data.id_web_user +'</td>'+
                        '                      <td>'+ data.email_web_user +'</td>' +
                        '</tr>';
                })

                $('#dataTableUser').DataTable().destroy();
                $('#user-content').html(html);
                $('#dataTableUser').DataTable();
                $('.modal-dialog').scrollTop(0);

            }
        })
    }

    $('#dataTableUser').on( 'click', 'tbody tr', function () {
        current_user = $('#dataTableUser').DataTable().row( this ).data()[0];
        email_web_user = $('#dataTableUser').DataTable().row( this ).data()[1];


        $('.id_web_user_chat').val(current_user)
        get_message_detail(current_user);
        $('.current-user').html(email_web_user);
        $('.message-input').css('visibility', 'visible');
        $('.main_chat_logo').css('display', 'none');
        $('.history').css('display', 'block');
        $('#history-content').html('<p class="middle"> <img style="max-width: 300px; max-height: 300px;" class="loading-history" src="<?php echo base_url('assets/images/load.gif');?>"></p>');

        get_all_orders(current_user);

        $('#user-modal').modal('hide');
    });

    $(document).ready(function(){
        user = findGetParameter('user');
        order = findGetParameter('order');

        if(user != null){
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'get_user_by_email',
                data: {user: user},// the url where we want to POST// our data object
                dataType: 'json',
                success: function (data) {
                    if(data != null){
                        current_user = data.id_web_user;
                        $('.id_web_user_chat').val(current_user)

                        get_message_detail(current_user);
                        $('.current-user').html(user);
                        $('.message-input').css('visibility', 'visible');
                        $('.main_chat_logo').css('display', 'none');
                        $('.history').css('display', 'block');
                        $('#history-content').html('<p class="middle"> <img style="max-width: 300px; max-height: 300px;" class="loading-history" src="<?php echo base_url('assets/images/load.gif');?>"></p>');

                        get_all_orders(current_user, order);

                    } else {
                        console.log('Data User tidak ditemukan')
                    }


                }
            })
        }
    })

    function get_message_header(){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_message_header', // the url where we want to POST// our data object
            data: {user_search: user_search, message_filter: message_filter},
            dataType: 'json',
            success: function (data) {
                html = '';

                data.forEach(function(data){
                    html += '<li class="contact" id="'+ data.id_web_user +'">\n' +
            '                    <div class="wrap">\n' +
            '                        <div class="meta">\n' +
            '                            <p>';


            if(data.is_read == '0' && data.id_admin == '0'){
                html += '<span class="notifDot">';
            }


            html +=        '</span><strong class="name">'+ data.email_web_user +'</strong> ' +
                '<div class="unread"><i class="fa fa-ellipsis-v" style="float: right"></i>' +
                '<div class="mark_as_unread" id="unread_'+ data.id_web_user +'">' +
                'Tandai belum dibaca</div></div>' +
                '</p>\n' +
            '                            <p class="preview">'+ data.header_message +'</p>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </li>';
                })

                $('#contacts-content').html(html);

                $('.contact').click(function(e){
                    $('.loading').css("display", "block");
                    messages = [];
                    e.preventDefault();
                    $('.contact').removeClass('active');
                    $(this).addClass('active');
                    current_user = $(this).attr('id');
                    $('.id_web_user_chat').val(current_user);
                    read_all = true;
                    get_message_detail(current_user);
                    $(this).find('.meta').find('.notifDot').css('display', 'none');
                    $('.current-user').html($(this).find('.meta').find('.name').html());
                    $('.message-input').css('visibility', 'visible');
                    $('.main_chat_logo').css('display', 'none');
                    $('.history').css('display', 'block');
                    $('#history-content').html('<p class="middle"> <img style="max-width: 300px; max-height: 300px;" class="loading-history" src="<?php echo base_url('assets/images/load.gif');?>"></p>');

                    get_all_orders(current_user);

                })

                $('.fa-ellipsis-v, .mark_as_unread').click(function(e){
                    e.stopPropagation();
                    read_all = false;
                    id_web_user = $(this).attr('id').split('unread_')[1];
                    $.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: admin_url + 'mark_as_unread', // the url where we want to POST// our data object
                        data: {id_web_user: id_web_user},
                        dataType: 'json',
                        success: function(response){
                            get_message_header()
                        }
                    });

                })

                $('.unread').hover(function(){
                    $(this).find('.mark_as_unread').fadeIn(50);
                }, function(){
                    $(this).find('.mark_as_unread').css('display', 'none');
                })
            }
        })
    }

    function get_message_detail(id_web_user, reset = true){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_message_detail', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_web_user: id_web_user, read_all: read_all},
            success: function (data) {
                html = '';

                data.forEach(function(data){
                    if(!messages.includes(data.id_web_chat)){
                        messages.push(data.id_web_chat);
                        if(data.id_admin == 0){
                            // retrieve
                            html += '<li class="replies">\n';

                            if(data.img_web_chat == ''){

                                if(data.ucode_product_web_chat != 0){
                                    //attach product
                                    html += '<p>' +
                                        '<a style="margin-bottom: 5px;  cursor: pointer;" href="<?php echo base_url ('product?prod=')?>'+ data.art_number_web_product +'&color=' + data.nama_web_col +'" target="_blank">' +
                                        '<table style="border-bottom: 1px solid lightgrey"><tr>' +
                                        '<td><img style="max-height: 50px; max-width: 50px;" src="<?php echo base_url()?>'+ data.file_web_image +'"></td>' +
                                        '<td style="width: 5%"></td>' +
                                        '<td style="vertical-align: middle !important; color: #a50000 !important;"><span>' +data.nama_web_product + '</span></td>' +
                                        '</tr>';

                                    if(data.active_web_product == '0'){
                                        html += '<span style="color: black;">Produk tidak aktif!</span><br>'
                                    }

                                    if(data.active_web_catprod == '0'){
                                        html += '<span style="color: black;">Kategori produk tidak aktif!</span><br>'
                                    }

                                    if(data.active_web_col == '0'){
                                        html += '<span style="color: black;">Warna produk tidak aktif!</span><br>'
                                    }

                                    if(data.active_web_product == '0' || data.active_web_catprod == '0' || data.active_web_col == '0'){
                                        html += '<br>'
                                    }

                                    html +=    '</table>' +
                                        '</a><br>'+ data.message_web_chat +'<br><span style="font-size: 9px; color: darkgray;">'+ data.timestamp_web_chat +'</span>' +
                                        '</p>';
                                } else {
                                    html +=  '<p>'+ data.message_web_chat +'<br><span style="font-size: 9px; color: darkgray;">'+ data.timestamp_web_chat +'</span>' +
                                        '</p>\n';
                                }



                            } else {
                                html +=  '<img style="    max-width: 200px; max-height: 300px; float:right;" src="<?php echo base_url()?>'+ data.img_web_chat +'">';
                            }


                        } else {
                            // sent
                            html += '<li class="sent">\n';

                            if(data.img_web_chat == ''){
                                if(data.ucode_product_web_chat != 0){
                                    //attach product
                                    html += '<p>' +
                                        '<a style="margin-bottom: 5px; cursor: pointer;" href="<?php echo base_url ('product?prod=')?>'+ data.art_number_web_product +'&color=' + data.nama_web_col +'" target="_blank">' +
                                        '<table style="border-bottom: 1px solid lightgrey"><tr>' +
                                        '<td><img style="max-height: 50px; max-width: 50px;" src="<?php echo base_url()?>'+ data.file_web_image +'"></td>' +
                                        '<td style="width: 5%"></td>' +
                                        '<td style="vertical-align: middle !important; color: white !important;">' +data.nama_web_product + '</td>' +
                                        '</tr>';


                                    if(data.active_web_product == '0'){
                                        html += '<span style="color: white;">Produk tidak aktif!</span><br>'
                                    }

                                    if(data.active_web_catprod == '0'){
                                        html += '<span style="color: white;">Kategori produk tidak aktif!</span><br>'
                                    }

                                    if(data.active_web_col == '0'){
                                        html += '<span style="color: white;">Warna produk tidak aktif!</span><br>'
                                    }

                                    if(data.active_web_product == '0' || data.active_web_catprod == '0' || data.active_web_col == '0'){
                                        html += '<br>'
                                    }

                                    html +=    '</table>' +
                                        '</a><br>'+ data.message_web_chat +'<br><span style="font-size: 9px;">'+ data.timestamp_web_chat +'</span>' +
                                        '</p>';
                                } else {
                                    html +=  '<p>'+ data.message_web_chat +'<br><span style="font-size: 9px;">'+ data.timestamp_web_chat +'</span>' +
                                        '</p>\n';
                                }

                            } else {
                                html +=  '<img style="    max-width: 200px; max-height: 300px; float:left;" src="<?php echo base_url()?>'+ data.img_web_chat +'">';
                            }


                            html +=  '</li>';
                        }
                    }
                })

                if(reset == true){
                    $('#messages-content').html(html);
                    $(".messages").animate({ scrollTop: $(".messages").scrollTop() + 10000 }, "fast");
                } else {
                    $('#messages-content').append(html);
                }

                $('#messages-content').prepend(' <div id="end-content"></div>')
                $('.loading').css("display", "none");




            }
        })
    }

    function status_pesanan(status, confirm_payment){
        switch(status) {
            case '1':
                if(confirm_payment == 0){
                    return "Diterima - Belum Bayar";
                } else {
                    return "Diterima - Menunggu Pengecekan";
                }

                break;
            case '2':
                return "Diproses";
                break;
            case '3':
                return "Dikirim";
                break;
            case '4':
                return "Selesai";
                break;
            case '5':
                return "Dibatalkan";
                break;
        }
    }

    function convertToRupiah(angka)
    {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('')+',00';
    }

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }



    get_message_header()
</script>
</body></html>