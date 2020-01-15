@extends('admin.base')
@section('javascript')
    <script>
        $(function () {
            $('input[name=type]').change(function () {
                // DrinkかFoodになるはず
                console.log($(this).val());
                if ($(this).val() === 'Drink') {
                    $('input[name=drink_type]').attr('disabled', false);
                    $('input[name=spiciness]').attr('disabled', true);
                }
                if ($(this).val() === 'Food') {
                    $('input[name=drink_type]').attr('disabled', true);
                    $('input[name=spiciness]').attr('disabled', false);
                }
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
                const type= 'image';
                $(this).closest(`.${type}-row`).remove();
            });

            /*戻る*/
            $('.return').click(function (){
                const $form = $('#return');
                $form.submit();
            });
            /*新規作成*/
            $('.create').click(function (){
                const $form = $('#create');
                $form.submit();
            });

        });
    </script>
@endsection

@section('content')
    <form id="return" action="{{ route('admin.menu_index') }}">
        <button type="button" class="btn btn-outline-primary return">戻る</button>
    </form>

    <form action="{{ route('admin.menu_store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col">
                {!! form_row($form->type) !!}
            </div>
        </div>
        <div class="row">
            <div class="col">
                {!! form_row($form->name) !!}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="image-collection-container" data-prototype="{{ form_row($form->images->prototype()) }}">
                    {!! form_widget($form->images) !!}
                </div>
                <button type="button" class="btn-sm btn-outline-dark add-to-image-collection">+</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {!! form_row($form->drink_type) !!}
            </div>
        </div>
        <div class="row">
            <div class="col">
                {!! form_row($form->spiciness) !!}
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary create" >作成する</button>
    </form>

@endsection

