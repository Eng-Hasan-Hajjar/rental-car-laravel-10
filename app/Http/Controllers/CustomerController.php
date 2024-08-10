<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

    // جلب المستخدمين الذين دورهم 'customer' فقط
    $customers = Customer::whereHas('user', function($query) {
        $query->where('role', 'customer');
    })->latest()->paginate(5);
    $users = User::latest()->paginate(5);
    return view('backend.customers.index', compact('customers','users'))
                ->with('i', (request()->input('page', 1) - 1) * 5);

        /*
        $user = auth()->user();
        $customers = Customer::latest()->paginate(5);
        $users = User::latest()->paginate(5);
        // تحقق مما إذا كان مديرًا وإذا لم يكن لديه معرف المستخدم (user_id)
        if (auth()->user()->role === 'customer' ) {
            $customers = Customer::latest()->paginate(5);
        }

        return view('backend.customers.index',compact('customers','users'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
                    */
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
                // تحقق مما إذا كان مديرًا وإذا لم يكن لديه معرف المستخدم (user_id)
        if (auth()->user()->role === 'admin' && !$request->has('user_id')) {
            Auth::logout(); // تسجيل خروج المدير
            return redirect()->route('register')
                            ->with('info', 'يرجى إنشاء حساب مستخدم جديد أولاً.');
        }
        return view('backend.customers.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'حقل  الاسم مطلوب',
            'phone.required' => 'حقل رقم الهاتف مطلوب',
            'phone.numeric' => 'هاتف المستخدم غير صالح',
            'specialty.required' => 'حقل الاختصاص  مطلوب',
            'work.required' => 'حقل العمل مطلوب',
            'nationality.required' => 'حقل الجنسية مطلوب',
            'current_location.required' => 'حقل الموقع الحالي مطلوب',
            'gender.required' => 'حقل الجنس مطلوب',
            'birthday.required' => 'حقل تاريخ الميلاد مطلوب',
            'driving_license_number.required' => 'حقل رقم الشهادة  مطلوب',
        ];
        $request->validate([
            'phone'=> 'required|numeric',
            'work'=>  'required',
            'nationality'=> 'required',
            'current_location' => 'required',
            'gender'=>  'required',
            'birthday'=> 'required',
            'driving_license_number' => 'required|string|max:255',
        ], $messages);

                    // التحقق من عمر المستخدم
            $age = Carbon::parse($request->birthday)->age;
            if ($age < 18) {
                return redirect()->back()->withErrors(['birthday' => 'يجب أن يكون عمرك فوق 18 عامًا لتتمكن من التسجيل.']);
            }


        // الحصول على المستخدم المسجل
        $user = auth()->user();
        $customer = new Customer($request->all());
        $user->customer()->save($customer);
        // التحقق من وجود المستخدم
        if ($user &&  $user->role == 'customer') {
            $customer = $user->customer;
            return view('backend.customers.showyou', compact('customer','user'));
        }
        return redirect()->route('customers.index')
                        ->with('success','customer created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $user = auth()->user();
        $users = User::all();
        return view('backend.customers.show',compact('customer','users'));
    }

    public function showCustomerByUserId($userId)
    {
        $customer = Customer::where('user_id', $userId)->first();
        if (!$customer) {
            return redirect()->route('customers2.input')->with('error', 'لم يتم العثور على معلومات الزائر، يرجى استكمال البيانات.');
        }
        return view('backend.customers.showyou', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('backend.customers.edit',compact('customer'));
    }
    public function edityou(Customer $customer)
    {
        return view('backend.customers.edityou',compact('customer'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $messages = [
            'phone.required' => 'حقل رقم الهاتف مطلوب',
            'phone.numeric' => 'هاتف المستخدم غير صالح',
            'specialty.required' => 'حقل الاختصاص  مطلوب',
            'work.required' => 'حقل العمل مطلوب',
            'nationality.required' => 'حقل الجنسية مطلوب',
            'current_location.required' => 'حقل الموقع الحالي مطلوب',
            'gender.required' => 'حقل الجنس مطلوب',
            'birthday.required' => 'حقل تاريخ الميلاد مطلوب',
        ];

        $request->validate([
            'phone'=> 'required|numeric',
            'work'=>  'required',
            'nationality'=> 'required',
            'current_location' => 'required',
            'gender'=>  'required',
            'birthday'=> 'required',
            'driving_license_number' => 'required|string|max:255',
        ], $messages);

        $customer->update($request->all());

        if (Auth::user()->role === 'customer') {
            return redirect()->route('dashboard')
                             ->with('success', 'تم تحديث معلوماتك  بنجاح');
        }
        return redirect()->route('customers.index')
                        ->with('success','تم تحديث معلوماتك  بنجاح');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
                        ->with('success','customer deleted successfully');
    }

    public function input()
    {
        return view('backend.customers.input');
    }
    public function input2(Request $request)
    {
        $messages = [
            'phone.required' => 'حقل رقم الهاتف مطلوب',
            'phone.numeric' => 'هاتف المستخدم غير صالح',
            'specialty.required' => 'حقل الاختصاص  مطلوب',
            'work.required' => 'حقل العمل مطلوب',
            'nationality.required' => 'حقل الجنسية مطلوب',
            'current_location.required' => 'حقل الموقع الحالي مطلوب',
            'gender.required' => 'حقل الجنس مطلوب',
            'birthday.required' => 'حقل تاريخ الميلاد مطلوب',
        ];

        $request->validate([
            'phone'=> 'required|numeric',
            'work'=>  'required',
            'nationality'=> 'required',
            'current_location' => 'required',
            'gender'=>  'required',
            'birthday'=> 'required',
            'driving_license_number' => 'required|string|max:255',
        ], $messages);
//dd($request);
          // الحصول على المستخدم المسجل
        $user = auth()->user();
        $customer = new Customer($request->all());
        $user->customer()->save($customer);
          // التحقق من وجود المستخدم
        if ($user) {
            $customer = $user->customer;
            return view('backend.customers.showyou', compact('customer','user'));
        }
        return redirect()->route('customers.index')
                        ->with('success','تم التحديث بنجاح ');
    }


}
