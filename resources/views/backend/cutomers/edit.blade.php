
<!-- resources/views/reservations/edit.blade.php -->

@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('title')
   التعديل
@endsection

@section('header')
{{ Html::style('hdesign/hstyle.css') }}
    <!-- DataTables -->
    {{ Html::style('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}
    {{ Html::style('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}
@endsection
@section('content')
    <div class="container helementedit">
        <div class="card ">
            <div class="card-header">تعديل </div>

            <div class="card-body">
                <form method="POST" action="{{ route('customers.update', $visitor) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="phone">الهاتف  </label>
                        <input type="phone" name="phone" class="form-control" id="phone" value="{{$customer->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="work">العمل  </label>
                        <input type="text" name="work" class="form-control" id="work" value="{{ $customer->work }}">
                    </div>
                    <div class="form-group">
                        <label for="nationality">الجنسية  </label>
                        <input type="text" name="nationality" class="form-control" id="nationality" value="{{$customer->nationality  }}">
                    </div>
                    <div class="form-group">
                        <label for="current_location">الموقع الحالي  </label>
                        <input type="text" name="current_location" class="form-control" id="current_location" value="{{$customer->current_location }}">
                    </div>

                    <div class="form-group">
                        <label for="gender"> الجنس </label>
                        <select name="gender" class="form-control" id="gender">
                                <option value="1" {{ $customer->gender == '1' ? 'selected' : '' }}>ذكر </option>
                                <option value="0" {{ $customer->gender == '0' ? 'selected' : '' }}> أنثى </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthday">الميلاد  </label>
                        <input type="date" name="birthday" class="form-control" id="birthday" value="{{$visitor->birthday  }}">
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ </button>
                    <!-- زر الرجوع -->
                    @if(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))

                          <a href="{{ url('/adminpanel/customers') }}" class="btn btn-secondary" >  الزائرين </a>
                    @else
                         <a href="{{ url('/dashboard') }}" class="btn btn-secondary" >  رجوع </a>

                    @endif

                </form>
            </div>
        </div>
    </div>
@endsection

