<?php

use App\Models\ChMessage as Message;

if (!function_exists('check_unread_messages')) {
  function check_unread_messages($id) {
    return Message::where('to_id', 1)->where('seen', 0)->count();
  }
}