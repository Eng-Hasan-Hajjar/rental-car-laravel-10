{{-- website --}}


<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-users"></i>
    <p>
     الموقع
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
  <li class="nav-item">
      <a href="{{url('/')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>الصفحة الرئيسية</p>
      </a>
    </li>


  </ul>
</li>


{{-- Customer --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
       الزبائن
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/customers/create')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>إضافة  زبون </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/customers/')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>كل  الزبائن</p>
        </a>
      </li>

    </ul>
  </li>



{{-- cars --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
         السيارات
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/car/create')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>إضافة  سيارة </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/car/')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>كل  السيارات</p>
        </a>
      </li>

    </ul>
  </li>

{{-- Guides --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
         الكراجات
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/create')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>إضافة  كراج </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>كل  الكراجات</p>
        </a>
      </li>

    </ul>
  </li>




{{-- Guides --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
         الصيانات
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/create')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>إضافة  صيانة </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>كل  الصيانات</p>
        </a>
      </li>

    </ul>
  </li>


{{-- Guides --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
         الحجوزات
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/create')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>إضافة  حجز </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>كل  الحجوزات</p>
        </a>
      </li>

    </ul>
  </li>


{{-- Guides --}}


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
         الأساطيل
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/create')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>إضافة  أسطول </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/adminpanel/cars/')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>كل  الأساطيل</p>
        </a>
      </li>

    </ul>
  </li>





            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-danger"></i>
              <p>
             <!--  {Auth::user()->name}}-->
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">

                 <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

 <form id="logout-form"  action="{{ route('logout') }}" method="POST" >
                                        @csrf
                                    </form>



                </a>
              </li>


            </ul>
          </li>
