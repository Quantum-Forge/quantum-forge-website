
<section class="news-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="clearfix row g-0">
                @php
                    $newsArticles = $newsArticles ?? collect();
                    $firstArticle = $newsArticles->get(0);
                    $secondArticle = $newsArticles->get(1);
                    $thirdArticle = $newsArticles->get(2);
                @endphp

                <!-- Column for the first two articles -->
                <div class="column col-lg-8 col-md-12 col-sm-12">
                    @if($firstArticle)
                        <div class="news-block">
                            <div class="inner-box">
                                <div class="clearfix">
                                    <div class="image-column col-lg-6 col-md-6 col-sm-12">
                                        <div class="inner-column">
                                            <div class="image">
                                                <a href="{{ $firstArticle->news_url }}"><img style="width: 390px; height: 390px;" src="{{ $firstArticle->news_image_src }}" alt="{{ $firstArticle->title ?? '' }}" /></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-column col-lg-6 col-md-6 col-sm-12">
                                        <div class="inner-column">
                                            <div class="arrow-one"></div>
                                            <div class="title">{{ $firstArticle->news_category_label }}</div>
                                            <h4><a href="{{ $firstArticle->news_url }}">{{ $firstArticle->news_title_short }}</a></h4>
                                            <div class="post-date">{{ \Carbon\Carbon::parse($firstArticle->news_published_at)->format('F jS, Y') }} by <span>Admin</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($secondArticle)
                        <div class="news-block">
                            <div class="inner-box">
                                <div class="clearfix row g-0">
                                    <div class="content-column col-lg-6 col-md-6 col-sm-12 order-lg-1 order-2">
                                        <div class="inner-column">
                                            <div class="arrow-two"></div>
                                            <div class="title">{{ $secondArticle->news_category_label }}</div>
                                            <h4><a href="{{ $secondArticle->news_url }}">{{ $secondArticle->news_title_short }}</a></h4>
                                            <div class="post-date">{{ \Carbon\Carbon::parse($secondArticle->news_published_at)->format('F jS, Y') }} by <span>Admin</span></div>
                                        </div>
                                    </div>
                                    <div class="image-column col-lg-6 col-md-6 col-sm-12 order-lg-2 order-1">
                                        <div class="inner-column">
                                            <div class="image">
                                                <a href="{{ $secondArticle->news_url }}"><img style="width: 390px; height: 390px;" src="{{ $secondArticle->news_image_src }}" alt="{{ $secondArticle->title ?? '' }}" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Column for the third article -->
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    @if($thirdArticle)
                        <div class="news-block-two">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{ $thirdArticle->news_url }}"><img style="width: 390px; height: 390px;" src="{{ $thirdArticle->news_image_src }}" alt="{{ $thirdArticle->title ?? '' }}" /></a>
                                    <div class="arrow"></div>
                                </div>
                                <div class="lower-content">
                                    <div class="title">{{ $thirdArticle->news_category_label }}</div>
                                    <h4><a href="{{ $thirdArticle->news_url }}">{{ $thirdArticle->news_title_short }}</a></h4>
                                    <div class="post-date">{{ \Carbon\Carbon::parse($thirdArticle->news_published_at)->format('F jS, Y') }} by <span>Admin</span></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if($newsArticles->isEmpty())
                    <p class="text-center">No news available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</section>
