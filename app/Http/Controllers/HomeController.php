<?php

namespace App\Http\Controllers;

use App\Classes\enums\RoleEnum;
use App\Faq;
use App\Maintenance;
use App\Order;
use App\Tariff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole(RoleEnum::ROLE_ADMINISTRATOR)) {
            return view('admin.index')
                ->with('usersAmount', $usersAmount = User::clients()->count())
                ->with('ordersActiveAmount', $ordersActiveAmount = Order::inprogress()->count())
                ->with('ordersCompletedAmount', $ordersCompletedAmount = Order::withstatus('COMPLETED')->count())
                ->with('ordersBasicAmount', $ordersBasicAmount = Order::withtariff('BASE')->count())
                ->with('ordersMediumAmount', $ordersMediumAmount = Order::withtariff('MEDIUM')->count())
                ->with('ordersProAmount', $ordersProAmount = Order::withtariff('PRO')->count());
        }
        if (auth()->user()->hasRole(RoleEnum::ROLE_TECHNICAL_MANAGER)) {
            return redirect()->action('OrderController@index');
        }
        if (auth()->user()->hasRole(RoleEnum::ROLE_OPTIMIZER)) {
            return view('optimizer.index');
        }
        if (auth()->user()->hasRole(RoleEnum::ROLE_CLIENT)) {
            return view('client.index');
        }

    }

    public function charts()
    {
        return view('client.charts');
    }

    public function faqAll(Request $request)
    {
        $faqs = Faq::all();
        return view('client.faq.index', compact('faqs'))->with('request', $request)->with('faqCategories', $faqs);
    }

    public function faqShow(Request $id)
    {
        $faq = Faq::find($id);
        return view('client.faq.show', compact('faq', 'id'));
    }

    public function searchFaq(Request $request)
    {
        $queryBuilder = Faq::existing();

        if ($request->get('category')) {
            $queryBuilder = $queryBuilder->withCategory($request->get('category'));
        }
        if ($request->get('question')) {
            $queryBuilder = $queryBuilder->questionIsMatching($request->get('question'));
        }

        $faqs = $queryBuilder->get();
        $faqCategories =DB::table('faqs')->select('category')->get();

        return view('client.faq.index', compact('faqs'))->with('request', $request)->with('faqCategories', $faqCategories);
    }
}
