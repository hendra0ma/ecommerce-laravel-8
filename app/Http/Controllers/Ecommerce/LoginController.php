<?php

namespace App\Http\Controllers\Ecommerce;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('customer.dashboard'));
        return view('ecommerce.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string'
        ]);

        $auth = $request->only('email', 'password');
        $auth['status'] = 1;
        // var_dump(auth()->guard('customer')->attempt($auth));
        // die;
        if (auth()->guard('customer')->attempt($auth)) {
            return redirect()->intended(route('front.index'));
        }

        return redirect()->back()->with(['error' => 'Email / Password Salah']);
    }

    public function dashboard()
    {
        $orders = Order::selectRaw('COALESCE(sum(CASE WHEN status = 0 THEN subtotal END), 0) as pending, 
            COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
            COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')
            ->where('customer_id', auth()->guard('customer')->user()->id)->get();

        return view('ecommerce.dashboard', compact('orders'));
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect(route('customer.login'));
    }
    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => ['required', 'numeric', 'min:8'],
            'address' => ['required', 'string'],
            'district_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // dd([$request->password, Hash::make($request->password),]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => $request->password,
            'district_id' => $request->district_id,
            'status' => 1

        ]);

        return redirect()->route('front.index');
    }
}
