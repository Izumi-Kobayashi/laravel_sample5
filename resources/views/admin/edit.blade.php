@extends('admin.base')
@section('javascript')
    <script>
        $(function () {
            $(`.image-row`).each(function (i) {
                $(this).append(`<div class="form-group col-2 d-flex align-items-center"><div><button type="button" class="btn-sm btn-outline-danger delete-image-row">×</button></div></div>`)
            });
            $('.add-to-image-collection').click(function () {
                const type = 'image';
                const container = $(`.${type}-collection-container`);
                const proto = container.data('prototype');
                const length = container.children().length;
                container.append(proto.replace(/__NAME__/g, length));
                $(`.${type}-row`).last().append(`<div class="form-group col-2 d-flex align-items-center"><button type="button" class="btn-sm btn-outline-danger delete-${type}-row">×</button></div>`);
            });

            $(document).on('click', '.delete-image-row', function () {
                const type = 'image';
                $(this).closest(`.${type}-row`).remove();
            });

            /*戻る*/
            $('.return').click(function (){
                const $form = $('#return');
                $form.submit();
            });

            /*価格とサイズ設定*/
            $('.product').click(function (){
                const $form = $('#product');
                $form.submit();
            });

            /*変更*/
            $('.update').click(function (){
                const $form = $('#update');
                $form.submit();
            });
        });

    </script>
@endsection
@section('css')
    <style>
        .main {
            width: 50%;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
@endsection
@section('content')
    <div class="main">

    <form id="update" action="{{ route('admin.menu_update', ['id' => $menu->id]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="form-group row">
            <div class="col">
            メニュータイプ：{!! form_widget($form->type) !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                メニュー名：{!! form_widget($form->name) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="image-collection-container" data-prototype="{{ form_row($form->images->prototype()) }}">
                 イメージファイル：{!! form_widget($form->images) !!}
            </div>
            <button type="button" class="btn-sm btn-outline-dark add-to-image-collection">+</button>
        </div>
        <div class="form-group">
            サイズ：{!! form_widget($form->sizes) !!}
        </div>
        <div class="form-group">
            ドリンクタイプ：{!! form_widget($form->drink_type) !!}
        </div>
        <div  class="form-group">
            スパイス指数：{!! form_widget($form->spiciness) !!}
        </div>
    </form>
        <div class="d-flex justify-content-end mt-2">
            <form id="return" action="{{ route('admin.menu_index') }}">
                <button type="button" class="btn btn-outline-secondary return mr-2">戻る</button>
            </form>
            <button type="button" class="btn btn-outline-primary update mr-2" >変更する</button>
            <form id="product" action="{{ route('admin.menu_product',  ['menu' => $menu->id]) }}">
                <button type="button" class="btn btn-outline-primary product" >サイズと価格の設定</button>
            </form>
        </div>
    </div>


@endsection

