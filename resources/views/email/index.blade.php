@section('title','Danh sách Email')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH EMAIL</h1>

   {{ Breadcrumbs::render('email.index') }}

@endsection


@section('content')

<section class="section">
   <div class="row">
        <div class="col-lg-12">
        <div class="container">
<div class="content-wrapper">
          <div class="email-wrapper wrapper">
            <div class="row align-items-stretch">
              <div class="mail-sidebar d-none d-lg-block col-md-2 pt-3 bg-white">
                <div class="menu-bar">
                  <ul class="menu-items">
                    <li class="compose mb-3"><button class="btn btn-primary btn-block">Compose</button></li>
                    <li class="active"><a href="#"><i class="mdi mdi-email-outline"></i> Inbox</a><span class="badge rounded-pill bg-success">8</span></li>
                    <li><a href="#"><i class="mdi mdi-share"></i> Sent</a></li>
                    <li><a href="#"><i class="mdi mdi-file-outline"></i> Draft</a><span class="badge rounded-pill bg-warning">4</span></li>
                    <li><a href="#"><i class="mdi mdi-upload"></i> Outbox</a><span class="badge rounded-pill bg-danger">3</span></li>
                    <li><a href="#"><i class="mdi mdi-star-outline"></i> Starred</a></li>
                    <li><a href="#"><i class="mdi mdi-delete"></i> Trash</a></li>
                  </ul>
                </div>
              </div>
              <div class="mail-list-container col-md-3 pt-4 pb-4 border-end bg-white">
                <div class="border-bottom pb-4 mb-3 px-3">
                  <div class="form-group">
                    <input class="form-control w-100" type="search" placeholder="Search mail" id="Mail-rearch">
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">David Moore</p>
                    <p class="message_text">Hi Emily, Please be informed that the new project presentation is due Monday.</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list new_mail">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" checked=""> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Microsoft Account Password Change</p>
                    <p class="message_text">Change the password for your Microsoft Account using the security code 35525</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star favorite"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Sophia Lara</p>
                    <p class="message_text">Hello, last date for registering for the annual music event is closing in</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Stella Davidson</p>
                    <p class="message_text">Hey there, can you send me this year’s holiday calendar?</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star favorite"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">David Moore</p>
                    <p class="message_text">FYI</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star favorite"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Daniel Russel</p>
                    <p class="message_text">Hi, Please find this week’s update..</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"><label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Sarah Graves</p>
                    <p class="message_text">Hey, can you send me this year’s holiday calendar ?</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Bruno King</p>
                    <p class="message_text">Hi, Please find this week’s monitoring report in the attachment.</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Me, Mark</p>
                    <p class="message_text">Hi, Testing is complete. The system is ready to go live.</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Catherine Myers</p>
                    <p class="message_text">Template Market: Limited Period Offer!!! 50% Discount on all Templates.</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star favorite"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Daniel Russell</p>
                    <p class="message_text">Hi Emily, Please approve my leaves for 10 days from 10th May to 20th May.</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Sarah Graves</p>
                    <p class="message_text">Hello there, Make the most of the limited period offer. Grab your favorites</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">John Doe</p>
                    <p class="message_text">This is the first reminder to complete the online cybersecurity course</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> <i class="input-helper"></i></label></div>
                  <div class="content">
                    <p class="sender-name">Bruno</p>
                    <p class="message_text">Dear Employee, As per the regulations all employees are required to complete</p>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
              </div>
              <div class="mail-view d-none d-md-block col-md-9 col-lg-7 bg-white">
                <div class="row">
                  <div class="col-md-12 mb-4 mt-4">
                    <div class="btn-toolbar">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-reply text-primary mr-1"></i> Reply</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-reply-all text-primary mr-1"></i>Reply All</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-share text-primary mr-1"></i>Forward</button>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-attachment text-primary mr-1"></i>Attach</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-delete text-primary mr-1"></i>Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="message-body">
                  <div class="sender-details">
                    <img class="img-sm rounded-circle mr-3" src="http://www.urbanui.com/dashflat/template/images/faces/face11.jpg" alt="">
                    <div class="details">
                      <p class="msg-subject">
                        Weekly Update - Week 19 (May 8, 2017 - May 14, 2017)
                      </p>
                      <p class="sender-email">
                        Sarah Graves
                        <a href="#">itsmesarah268@gmail.com</a>
                        &nbsp;<i class="mdi mdi-account-multiple-plus"></i>
                      </p>
                    </div>
                  </div>
                  <div class="message-content">
                    <p>Hi Emily,</p>
                    <p>This week has been a great week and the team is right on schedule with the set deadline. The team has made great progress and achievements this week. At the current rate we will be able to deliver the product right on time and meet the quality that is expected of us. Attached are the seminar report held this week by our team and the final product design that needs your approval at the earliest.</p>
                    <p>For the coming week the highest priority is given to the development for <a href="http://www.urbanui.com/" target="_blank">http://www.urbanui.com/</a> once the design is approved and necessary improvements are made.</p>
                    <p><br><br>Regards,<br>Sarah Graves</p>
                  </div>
                  <div class="attachments-sections">
                    <ul>
                      <li>
                        <div class="thumb"><i class="mdi mdi-file-pdf"></i></div>
                        <div class="details">
                          <p class="file-name">Seminar Reports.pdf</p>
                          <div class="buttons">
                            <p class="file-size">678Kb</p>
                            <a href="#" class="view">View</a>
                            <a href="#" class="download">Download</a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="thumb"><i class="mdi mdi-file-image"></i></div>
                        <div class="details">
                          <p class="file-name">Product Design.jpg</p>
                          <div class="buttons">
                            <p class="file-size">1.96Mb</p>
                            <a href="#" class="view">View</a>
                            <a href="#" class="download">Download</a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="//cdn.materialdesignicons.com/3.7.95/css/materialdesignicons.min.css">
<style>
    /* Mail Sidebar */
@media (max-width: 769px) {
  .email-wrapper .mail-sidebar {
    position: relative;
  }
}

@media (max-width: 767.98px) {
  .email-wrapper .mail-sidebar {
    position: fixed;
    z-index: 99;
    background: #ffffff;
    width: 45%;
    min-width: 300px;
    left: -100%;
    display: block;
    transition: 0.4s ease;
    -webkit-transition: 0.4s ease;
    -moz-transition: 0.4s ease;
  }
}

.email-wrapper .mail-sidebar .menu-bar {
  width: 100%;
  float: right;
  height: 100%;
  min-height: 100%;
}

@media (max-width: 767.98px) {
  .email-wrapper .mail-sidebar .menu-bar {
    min-height: 100vh;
    max-height: 100%;
    height: auto;
    overflow-y: auto;
    overflow-x: hidden;
  }
}

.email-wrapper .mail-sidebar .menu-bar .menu-items {
  padding: 0;
  margin-bottom: 0;
  height: auto;
  list-style-type: none;
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li {
  padding: 10px 15px;
  transition: 0.4s;
  position: relative;
  display: -webkit-flex;
  display: flex;
  -webkit-align-items: center;
  align-items: center;
  -webkit-justify-content: space-between;
  justify-content: space-between;
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li:hover {
  background: rgba(240, 244, 249, 0.8);
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li a {
  color: #303a40;
  font-size: 0.75rem;
  text-decoration: none;
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li a i {
  margin-right: 8px;
  font-size: 0.75rem;
  line-height: 1.5;
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li.active {
  background: #e6e9ed;
  border-radius: 4px;
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li.active a {
  color: #464dee;
}

.email-wrapper .mail-sidebar .menu-bar .menu-items li.compose:hover {
  background: transparent;
}

.email-wrapper .mail-sidebar .menu-bar .online-status {
  margin-top: 1rem;
}

.email-wrapper .mail-sidebar .menu-bar .online-status .chat {
  font-size: 0.75rem;
  color: #464dee;
  margin-bottom: 0;
  font-weight: 600;
}

.email-wrapper .mail-sidebar .menu-bar .online-status .status {
  height: 10px;
  width: 10px;
  border-radius: 100%;
  display: inline-flex;
  justify-content: flex-start;
  transform: translateX(-43px) translateY(2px);
}

.email-wrapper .mail-sidebar .menu-bar .online-status .status:after {
  font-size: 12px;
  color: #2e383e;
  margin: -5px 0 0 18px;
}

.email-wrapper .mail-sidebar .menu-bar .online-status .status.offline {
  background: #ef5958;
}

.email-wrapper .mail-sidebar .menu-bar .online-status .status.offline:after {
  content: "Offline";
}

.email-wrapper .mail-sidebar .menu-bar .online-status .status.online {
  background: #0ddbb9;
}

.email-wrapper .mail-sidebar .menu-bar .online-status .status.online:after {
  content: "Online";
}

.email-wrapper .mail-sidebar .menu-bar .profile-list {
  padding: 10px 0;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item {
  border-bottom: 1px solid #e9e9e9;
  padding: 6px 0;
  display: block;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item:last-child {
  border-bottom: 0;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item a {
  text-decoration: none;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item a .pro-pic {
  display: -webkit-flex;
  display: flex;
  -webkit-align-items: center;
  align-items: center;
  padding: 0;
  width: 20%;
  max-width: 40px;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item a .pro-pic img {
  max-width: 100%;
  width: 100%;
  border-radius: 100%;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item a .user {
  width: 100%;
  padding: 5px 10px 0 15px;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item a .user .u-name {
  font-weight: 400;
  font-size: 0.75rem;
  line-height: 1;
  color: #000000;
}

.email-wrapper .mail-sidebar .menu-bar .profile-list-item a .user .u-designation {
  font-size: calc(0.75rem - 0.1rem);
  margin-bottom: 0;
}

.email-wrapper .sidebar.open {
  left: 0;
}

/* Mail List Container */
.email-wrapper .mail-list-container {
  border-left: 1px solid #e9e9e9;
  height: 100%;
  padding-left: 0;
  padding-right: 0;
}

.email-wrapper .mail-list-container a {
  text-decoration: none;
}

.email-wrapper .mail-list-container .mail-list {
  border-bottom: 1px solid #e9e9e9;
  display: flex;
  flex-direction: row;
  padding: 10px 15px;
  width: 100%;
}

.email-wrapper .mail-list-container .mail-list:last-child {
  border-bottom: none;
}

.email-wrapper .mail-list-container .mail-list .form-check {
  margin-top: 12px;
  width: 11%;
  min-width: 20px;
}

.email-wrapper .mail-list-container .mail-list .content {
  width: 83%;
  padding-left: 0;
  padding-right: 0;
}

.email-wrapper .mail-list-container .mail-list .content .sender-name {
  font-size: 0.75rem;
  font-weight: 400;
  max-width: 95%;
}

.email-wrapper .mail-list-container .mail-list .content .message_text {
  margin: 0;
  max-width: 93%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.email-wrapper .mail-list-container .mail-list .details {
  width: 5.5%;
}

.email-wrapper .mail-list-container .mail-list .details .date {
  text-align: right;
  margin: auto 15px auto 0;
  white-space: nowrap;
}

.email-wrapper .mail-list-container .mail-list .details i {
  margin: auto 0;
  color: #ddd;
}

.email-wrapper .mail-list-container .mail-list .details i.favorite {
  color: #fcd539;
}

.email-wrapper .mail-list-container .mail-list.new_mail {
  background: #e6e9ed;
}

.email-wrapper .mail-list-container .mail-list.new_mail .details .date {
  color: #000000;
}

/* Message Content */
.email-wrapper .message-body .sender-details {
  padding: 20px 15px 0;
  border-bottom: 1px solid #e9e9e9;
  display: -webkit-flex;
  display: flex;
}

.email-wrapper .message-body .sender-details .details {
  padding-bottom: 0;
}

.email-wrapper .message-body .sender-details .details .msg-subject {
  font-weight: 600;
}

.email-wrapper .message-body .sender-details .details .sender-email {
  margin-bottom: 20px;
  font-weight: 400;
}

.email-wrapper .message-body .sender-details .details .sender-email i {
  font-size: 1rem;
  font-weight: 600;
  margin: 0 1px 0 7px;
}

.email-wrapper .message-body .message-content {
  padding: 50px 15px;
}

.email-wrapper .message-body .attachments-sections ul {
  list-style: none;
  border-top: 1px solid #e9e9e9;
  padding: 30px 15px 20px;
}

.email-wrapper .message-body .attachments-sections ul li {
  padding: 10px;
  margin-right: 20px;
  border: 1px solid #e9e9e9;
  border-radius: 5px;
}

.email-wrapper .message-body .attachments-sections ul li .thumb {
  display: inline-block;
  margin-right: 10px;
}

.email-wrapper .message-body .attachments-sections ul li .thumb i {
  font-size: 30px;
  margin: 0;
  color: #2e383e;
}

.email-wrapper .message-body .attachments-sections ul li .details p.file-name {
  display: block;
  margin-bottom: 0;
  color: #2e383e;
}

.email-wrapper .message-body .attachments-sections ul li .details .buttons .file-size {
  margin-right: 10px;
  margin-bottom: 0;
  font-size: 13px;
}

.email-wrapper .message-body .attachments-sections ul li .details .buttons a {
  font-size: 13px;
  margin-right: 10px;
}

.email-wrapper .message-body .attachments-sections ul li .details .buttons a:last-child {
  margin-right: 0;
}
</style>
@endpush()
