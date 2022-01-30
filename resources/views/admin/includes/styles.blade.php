<!-- Pignose Calender -->
<link href="{{ $admin_source }}/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
<!-- Chartist -->
<link rel="stylesheet" href="{{ $admin_source }}/plugins/chartist/css/chartist.min.css">
<link rel="stylesheet" href="{{ $admin_source }}/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
<link href="{{ $admin_source }}/plugins/toastr/css/toastr.min.css" rel="stylesheet">
<link href="{{ $admin_source }}/plugins/sweetalert/css/sweetalert.css" rel="stylesheet">
<!-- Datatables -->
<link href="{{ $admin_source }}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="{{ $admin_source }}/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Custom Stylesheet -->
<link href="{{ $admin_source }}/css/style.css" rel="stylesheet">
<style>
    .menu-active{
        background-color: #fd7e14;
        color: #fff !important;
    }
    .chat-user:hover{
        background-color: #ffbb83;
    }
    .chat-wrapper, .message-wrapper {
        border: 1px solid #dddddd;
        border-radius: 2px;
        overflow-y: auto;
    }
    .chat-wrapper {
        height: 600px;
    }
    .message-wrapper {
        color: #000;
        padding: 10px;
        height: 470px;
        background-image: url('images/chat_background.jpg');
        opacity: .7;
    }
    .send-row{

    }
    .chat-user{
        cursor:pointer!important;
    }
    .messages{

    }
    .pending {
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #ffffff;
        }
        .sent {
            background: #0065b8;
            float: right;
            color: white;
            text-align: right;
        }
        .message p {
            margin: 5px 0;
        }

</style>
