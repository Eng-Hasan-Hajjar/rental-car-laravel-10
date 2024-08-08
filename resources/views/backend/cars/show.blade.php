@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')
@section('title')
    التفاصيل
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
    <div class=""  style=" direction: rtl;">



    <div class="container my-5" style="direction: rtl">
        <div class="card">
            <div align="right" style="width: 335px; margin-left: 335px ;margin-bottom: 20px">
                <a href="{{ route('cars.index') }}" class="btn btn-default">  رجوع </a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>العلامة التجارية:</strong> {{ $car->brand }}
                    </div>
                    <div class="col-md-6">
                        <strong>الموديل:</strong> {{ $car->model }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>العام:</strong> {{ $car->year }}
                    </div>
                    <div class="col-md-6">
                        <strong>اللون:</strong> {{ $car->color }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>الكراج:</strong> {{ $car->garage ? $car->garage ->name : 'غير محدد'}}
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>عدد المقاعد:</strong> {{ $car->seats }}
                    </div>
                    <div class="col-md-6">
                        <strong>الأجرة اليومية:</strong>
                            @if (Auth::check() && Auth::user()->created_at->diffInDays(now()) > 2 )
                                 {{ $discountedRate }} (ل.س)(سعر خاص)
                            @else
                                 {{ $car->daily_rate }} (ل.س)
                            @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>الحالة:</strong>

                        @if ( $car->status == "متوفرة")
                               متوفرة
                        @elseif ($car->status == "غير متوفرة")
                             غير متوفرة
                        @else
                             في الصيانة
                        @endif



                    </div>
                    <div class="col-md-6">
                        <strong>الوصف:</strong> {{ $car->description }}
                    </div>
                </div>
                @if ($car->image)
                    <div class="row mb-3">
                        <div class="col">
                            <strong>الصورة:</strong>
                            <img src="{{ URL::to('/') }}/images/{{ $car->image }}" class="img-thumbnail" style="width: 300px; height: auto;" />

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



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

        <div class="container" style=" direction: rtl;" >
            <div class="row" style=" direction: rtl;">
               <div class="col mt-4">
                  <form class="py-2 px-4" action="{{route('ratings.store')}}" style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off" style=" direction: rtl;">
                     @csrf
                     <p class="font-weight-bold ">التقييم </p>
                     <div class="form-group row">
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <div class="col">
                           <div class="rate">
                              <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                              <label for="star5" title="text">5 stars</label>
                              <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                              <label for="star4" title="text">4 stars</label>
                              <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                              <label for="star3" title="text">3 stars</label>
                              <input type="radio" id="star2" class="rate" name="rating" value="2">
                              <label for="star2" title="text">2 stars</label>
                              <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                              <label for="star1" title="text">1 star</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row mt-4">
                        <div class="col">
                           <textarea class="form-control" name="comment" rows="6 " placeholder="تعليق" maxlength="200"></textarea>
                        </div>
                     </div>
                     <div class="mt-3 text-right">
                        <button class="btn btn-sm py-2 px-3 btn-info"> تقييم
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>





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

