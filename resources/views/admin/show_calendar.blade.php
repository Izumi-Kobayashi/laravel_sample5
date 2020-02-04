@extends('admin.base')

@section('javascript')
  <script>
    $(function () {
      $('.prev-next-btn').click(function () {
        const month = $(this).data('month');
        const $form = $('.prev-next-form');
        $form.attr('action', `/admin/calendar/${month}/`);
        $form.submit();
      });
    });
  </script>
@endsection

@section('css')
  <style>
    .main {
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(160,166,179,0.3);
      border: 1px solid #e1e7ec;
      border-radius: 7px;
      padding: 30px 24px;
    }
  </style>
@endsection

@section('content')
<form class="prev-next-form"></form>

<div class="main">
  <div class="d-flex justify-content-between mb-3">
    <button class="btn btn-outline-secondary prev-next-btn" data-month="{{ $month->add(-1, 'month')->format('Y-m') }}"><</button>
    <div class="font-weight-bold">{{ $month->year }}年{{ $month->month }}月</div>
    <button class="btn btn-outline-secondary prev-next-btn" data-month="{{ $month->add(1, 'month')->format('Y-m') }}">></button>
  </div>

  <table class="table table-bordered m-0">
    <tr>
      <th style="color: red;"><div class="text-center">日</div></th>
      <th><div class="text-center">月</div></th>
      <th><div class="text-center">火</div></th>
      <th><div class="text-center">水</div></th>
      <th><div class="text-center">木</div></th>
      <th><div class="text-center">金</div></th>
      <th style="color: blue"><div class="text-center">土</div></th>
    </tr>
    @foreach ($calendar as $week)
    <tr>
      @foreach ($week as $date)
      <td style="width: 130px; height: 130px">
        <div class="text-right">
            <a href= "{{ route('admin.total_sale') }}?sumFrom={{$date->format('Y-m-d')}}&sumTo={{$date->format('Y-m-d')}}">{{ $date->day }}</a>
        </div>
      </td>
      @endforeach
    </tr>
    @endforeach
  </table>
</div>
@endsection
