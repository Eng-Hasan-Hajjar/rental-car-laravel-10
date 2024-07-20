@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('title')
       التعديل
@endsection
@section('header')
{{ Html::style('hdesign/hstyle.css') }}

{!! Html::style('cus/css/select2.css') !!}


@endsection
@section('content')
    <div class="container helementedit">
        <div class="card ">
            <div class="card-header">تعديل </div>

            <div class="card-body">
                <form method="post" action="{{ route('car.update', $id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('backend.cars.formEdit')

                </form>
            </div>
        </div>
    </div>
@endsection




@section('footer')


 {!! Html::script('cus/js/select2.js') !!}

  <script type="text/javascript">

    $('.select2').select2();

  </script>

@endsection
