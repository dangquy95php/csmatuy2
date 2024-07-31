@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', 'Bạn không có quyền truy cập! Vui lòng thực hiện thao tác khác.' ?: 'Forbidden'))
