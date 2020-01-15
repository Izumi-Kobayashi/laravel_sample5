@extends('admin.base')
@section('javascript')
    <script>
        $(function() {
            /*戻る*/
            $('.return').click(function (){
                const $form = $('#return');
                $form.submit();
            });

            /*再表示*/
            $('.view').click(function (){
                if (document.summary.sumFrom.value == "") {
                    alert("集計開始日を入力してください。");
                    return false;
                }

                if (document.summary.sumTo.value == "") {
                    alert("集計終了日を入力してください。");
                    return false;
                }

                const $form = $('#view');
                const fromDate = $(`#sumFrom`).val();
                const toDate = $(`#sumTo`).val();
                console.log('AAA');
                // formにhidden inputを作成する
                $('<input>').attr({
                    type: 'hidden',
                    name: `sumDates[0]`,
                    value: fromDate,
                }).appendTo($form);

                $('<input>').attr({
                    type: 'hidden',
                    name: `sumDates[1]`,
                    value: toDate,
                }).appendTo($form);

                $form.submit();
            });
        });
        </script>
@endsection
@section('content')
    <form id="return" action="{{ route('admin.menu_index') }}">
        <button type="button" class="btn btn-outline-primary return">戻る</button>
    </form>

    @if(count($rows) > 0)
        <table class="table table-bordered">
            <thead bgcolor="#f0e68c">
                <th>メニュー名</th><th>サイズ</th><th>売上数</th><th>売上金額</th>
            </thead>
            <tbody>

            @foreach($rows as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->size }}</td>
                    <td class="text-right">{{ number_format($row->num) }}</td>
                    <td class="text-right">￥{{ number_format($row->price) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form id="view" name="summary" action="{{ route('admin.total_sale') }}">
            <label for="sumFrom">集計期間</label>
            <input name="sumFrom" id="sumFrom" type="date" class="easyui-datebox" required>～</input>
            <input name="sumTo" id="sumTo" type="date" class="easyui-datebox" required></input>
            <button type="button" class="btn btn-outline-primary view">期間を指定して再表示</button>
        </form>
    @else
        <font color="orangered">選択されたメニューの売り上げデータはありません。</font>
    @endif

@endsection
