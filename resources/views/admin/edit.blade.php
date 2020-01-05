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
        });

    </script>
@endsection
@section('content')
    <form action="{{ route('admin.menu_index') }}">
        <input type="submit" value="メニュー一覧">
    </form>

    <form action="{{ route('admin.menu_product',  ['id' => $menu->id]) }}">
        <input type="submit" value="サイズと価格の設定">
    </form>

    <form action="{{ route('admin.menu_update', ['id' => $menu->id]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="form-row">
            {!! form_widget($form->type) !!}
        </div>
        <div>
            {!! form_widget($form->name) !!}
        </div>
        <div class="form-group">
            <div class="image-collection-container" data-prototype="{{ form_row($form->images->prototype()) }}">
                 {!! form_widget($form->images) !!}
            </div>
            <button type="button" class="btn-sm btn-outline-dark add-to-image-collection">+</button>
        </div>
        <div>
            {!! form_widget($form->sizes) !!}
        </div>
        <div>
            {!! form_widget($form->drink_type) !!}
        </div>
        <div>
            {!! form_widget($form->spiciness) !!}
        </div>
        <input type="submit" value="変更">
    </form>

@endsection

