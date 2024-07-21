@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')
@section('title')
    معلومات عن الصيانة
@endsection

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
   .rate {
       float: left;
       height: 46px;
       padding: 0 10px;
       }
       .rate:not(:checked) > input {
       position:absolute;
       display: none;
       }
       .rate:not(:checked) > label {
       float:right;
       width:1em;
       overflow:hidden;
       white-space:nowrap;
       cursor:pointer;
       font-size:30px;
       color:#ccc;
       }
       .rated:not(:checked) > label {
       float:right;
       width:1em;
       overflow:hidden;
       white-space:nowrap;
       cursor:pointer;
       font-size:30px;
       color:#ccc;
       }
       .rate:not(:checked) > label:before {
       content: '★ ';
       }
       .rate > input:checked ~ label {
       color: #ffc700;
       }
       .rate:not(:checked) > label:hover,
       .rate:not(:checked) > label:hover ~ label {
       color: #deb217;
       }
       .rate > input:checked + label:hover,
       .rate > input:checked + label:hover ~ label,
       .rate > input:checked ~ label:hover,
       .rate > input:checked ~ label:hover ~ label,
       .rate > label:hover ~ input:checked ~ label {
       color: #c59b08;
       }
       .star-rating-complete{
          color: #c59b08;
       }
       .rating-container .form-control:hover, .rating-container .form-control:focus{
       background: #fff;
       border: 1px solid #ced4da;
       }
       .rating-container textarea:focus, .rating-container input:focus {
       color: #000;
       }
       .rated {
       float: left;
       height: 46px;
       padding: 0 10px;
       }
       .rated:not(:checked) > input {
       position:absolute;
       display: none;
       }
       .rated:not(:checked) > label {
       float:right;
       width:1em;
       overflow:hidden;
       white-space:nowrap;
       cursor:pointer;
       font-size:30px;
       color:#ffc700;
       }
       .rated:not(:checked) > label:before {
       content: '★ ';
       }
       .rated > input:checked ~ label {
       color: #ffc700;
       }
       .rated:not(:checked) > label:hover,
       .rated:not(:checked) > label:hover ~ label {
       color: #deb217;
       }
       .rated > input:checked + label:hover,
       .rated > input:checked + label:hover ~ label,
       .rated > input:checked ~ label:hover,
       .rated > input:checked ~ label:hover ~ label,
       .rated > label:hover ~ input:checked ~ label {
       color: #c59b08;
       }
</style>
</head>


@section('content')
    <div class="jumbotron text-center"  style=" direction: rtl;">
        <div align="right" style="width: 335px; margin-left: 335px ;margin-bottom: 20px">
            <a href="{{ route('maintenances.index') }}" class="btn btn-default">  رجوع </a>
        </div>
        <br />
        @if (Auth::check())
        <!-- عرض رسائل الجلسة -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    @endif

    <table class="table table-striped">
        <tr>
            <th> تاريخ المتوقع للانتهاء من الصيانة</th>
            <td>{{ $maintenance->date }}</td>
        </tr>
        <tr>
            <th> التفاصيل </th>
            <td>{{ $maintenance->details }}</td>
        </tr>
        <tr>
            <th>تم الإنشاء بتاريخ </th>
            <td>{{ $maintenance->created_at }}</td>
        </tr>
        <tr>
            <th> رقم السيارة </th>
            <td>{{ $maintenance->car_id }}</td>
        </tr>
        <tr>
            <th> العلامة التجارية للسيارة </th>
            <td>{{ $maintenance->car->brand }}</td>
        </tr>
        <tr>
            <th>  المودل  </th>
            <td>{{ $maintenance->car->model }}</td>
        </tr>


        <tr>
            <th>الصورة</th>
            <td>
                <img src="{{ URL::to('/') }}/images/{{ $maintenance->car->image }}" class="img-thumbnail" style="width: 300px; height: auto;" />
            </td>
        </tr>





    </table>







    </div>






@endsection



<script>
    $(document).ready(function(){
        $('#rating').rating({
            showClear: false,
            showCaption: true
        });
    });
</script>


<style>
.form-group {
    margin-bottom: 1.5rem;
}

.rating {
    display: inline-block;
}

textarea.form-control {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}

.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}


    </style>

