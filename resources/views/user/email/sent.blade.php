@section('title','Danh sách Email đã gửi')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH EMAIL ĐÃ GỬI</h1>

   {{ Breadcrumbs::render('email.sent') }}

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
                    <li class="compose mb-3 text-white"><a href="{{ route('email.create') }}" class="btn btn-primary btn-block text-white"><i class="bi bi-pen-fill"></i><b>Soạn thư</b></a></li>
                    <li class="{{ request()->is('email/index') ? 'active' : '' }}"><a href="#"><i class="mdi mdi-email-outline"></i> Hộp thư đến</a><span class="badge rounded-pill bg-success">8</span></li>
                    <li class="{{ request()->is('email/sent') ? 'active' : '' }}"><a href="{{route('email.sent')}}"><i class="mdi mdi-share"></i> Thư đã gửi</a></li>
                    <li><a href="#"><i class="mdi mdi-file-outline"></i> Draft</a><span class="badge rounded-pill bg-warning">4</span></li>
                    <li><a href="#"><i class="mdi mdi-upload"></i> Outbox</a><span class="badge rounded-pill bg-danger">3</span></li>
                    <li><a href="#"><i class="mdi mdi-star-outline"></i> Starred</a></li>
                    <li><a href="#"><i class="mdi mdi-delete"></i> Trash</a></li>
                  </ul>
                </div>
              </div>
              <div class="mail-list-container col-md-3 pt-4 pb-4 border-end bg-white">
                @foreach($datas as $k => $items)
                <div class="mail-list justify-content-between new_mail">
                  <div class="content">
                    <p class="sender-name text-decoration-underline" role="button" data-bs-toggle="modal" data-bs-target="#basicModal{{ str_replace(' ', '', $k) }}">Xem danh sách người nhận</p>
                    <p class="message_text" att="{{ str_replace(' ', '', $k) }}">{{ $k }}</p>

                      <div class="modal fade" id="basicModal{{ str_replace(' ', '', $k) }}" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">DANH SÁCH NGƯỜI NHẬN</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Phòng/Khu</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày nhận</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($items as $kk => $item)
                                  <tr>
                                    <th scope="row">{{ ++$kk }}</th>
                                    <td>{{ $item->user->last_name }} {{ $item->user->first_name }}</td>
                                    <td>{{ $item->team->note }}</td>
                                    <td>{!! empty($item->seen) ? '<span class="badge bg-primary">Chưa xem</span>' : '<span class="badge bg-primary">Đã xem</span>' !!}</td>
                                    <td>{{ $item->created_at }}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="details">
                    <i class="mdi mdi-star-outline"></i>
                  </div>
                </div>
                @endforeach
                           </div>
              <div class="mail-view d-none d-md-block col-md-9 col-lg-7 bg-white">
              @foreach($datas as $k => $items)
                <div class="row d-none" id="{{ str_replace(' ', '', $k) }}">
                  <div class="col-md-12 mb-4 mt-4">
                    <div class="btn-toolbar">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-reply text-primary mr-1"></i>Phản hồi</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-delete text-primary mr-1"></i>Xóa</button>
                      </div>
                    </div>
                  </div>
                  <div class="message-body">
                    <div class="sender-details">
                      <div class="details">
                        <p class="msg-subject">
                          {!! $items[0]->title !!}
                        </p>
                      </div>
                    </div>
                    
                    <div class="message-content">
                      @if (isset($items[0]))
                        {!! $items[0]->content !!}
                      @endif
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
      $(".message_text").click(function() {
        $(".mail-list").each(function(k, item) {
          if ($(this).hasClass('bg-warning')) {
            $(this).removeClass('bg-warning');
          }
        });

        $('.mail-view .row').each(function(k, item) {
          if (!$(this).hasClass('d-none')) {
            $(this).addClass('d-none');
          }
        });

        $(this).closest('.mail-list').addClass('bg-warning')
        let id = $(this).attr('att');
        $("#"+ id).removeClass('d-none');
      });
    });
</script>
@endpush

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
