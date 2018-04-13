<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all()->toArray();
        return view('tech-manager.crud-faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqs = Faq::distinct()->get(['category']);
        return view('tech-manager.crud-faq.create', compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faq = new Faq;
        $faq->category = $request->categoryFaq;
        $faq->question = $request->questionFaq;
        $faq->answer = $request->answerFaq;
        $faq->save();
        return back()->with('success', 'Faq has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::find($id);
        return view('tech-manager.crud-faq.show',compact('faq','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faqCategories = Faq::distinct()->get(['category']);
        $faq = Faq::find($id);
        return view('tech-manager.crud-faq.edit',compact('faq','id'), compact('faqCategories', $faqCategories));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        $faq->category = $request->categoryFaq;
        $faq->question = $request->questionFaq;
        $faq->answer = $request->answerFaq;
        $faq->save();
        return redirect('manager/faq')->with('success','Faq has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();
        return redirect('manager/faq')->with('success','Faq has been  deleted');
    }

    public function findFaqCategory(Request $request)
    {
        $faqCategoryToFind = $request->get('faqCategoryToFind');
        $faqCategories = Faq::distinct()->where('category', 'like', "%$faqCategoryToFind%")->get(['category']);
        return view('tech-manager.crud-faq.templates.faq-category-finder')->with('faqCategories', $faqCategories);
    }
}
