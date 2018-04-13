<ul id="country-list">

    @foreach($faqCategories as $faqCategory)

        <li onclick="window.faqCategoryFinder.faqCategoryFinderCallback('{{$faqCategory->toJson()}}');">
            {{$faqCategory["category"]}}
        </li>
    @endforeach

</ul>
