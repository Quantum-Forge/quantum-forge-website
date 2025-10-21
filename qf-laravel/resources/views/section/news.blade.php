<!-- News Section migrated from legacy PHP -->
<section class="news-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="clearfix row g-0">
                <!-- Column for the first two articles -->
                <div class="column col-lg-8 col-md-12 col-sm-12">
                    @if(isset($newsData['articles']))
                        @php($count = 0)
                        @php($displayedArticles = [])
                        @foreach($newsData['articles'] as $index => $article)
                            @if(!empty($article['urlToImage']) && $count < 2 && !in_array($article['url'], $displayedArticles))
                                @if($count == 0)
                                    <!-- First News Block -->
                                    <div class="news-block">
                                        <div class="inner-box">
                                            <div class="clearfix">
                                                <!-- Image Column -->
                                                <div class="image-column col-lg-6 col-md-6 col-sm-12">
                                                    <div class="inner-column">
                                                        <div class="image">
                                                            <a href="{{ $article['url'] }}" target="_blank"><img style="width: 390px; height: 390px;" src="{{ $article['urlToImage'] }}" alt="" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Content Column -->
                                                <div class="content-column col-lg-6 col-md-6 col-sm-12">
                                                    <div class="inner-column">
                                                        <div class="arrow-one"></div>
                                                        <div class="title">{{ $article['source']['name'] ?? '' }}</div>
                                                        @php($title = $article['title'] ?? '')
                                                        @php($title = strlen($title) > 48 ? substr($title,0,45) . '...' : $title)
                                                        <h4><a href="{{ $article['url'] }}" target="_blank">{{ $title }}</a></h4>
                                                        <div class="post-date">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('F jS, Y') }} by <span>Admin</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Second News Block -->
                                    <div class="news-block">
                                        <div class="inner-box">
                                            <div class="clearfix row g-0">
                                                <!-- Content Column -->
                                                <div class="content-column col-lg-6 col-md-6 col-sm-12 order-lg-1 order-2">
                                                    <div class="inner-column">
                                                        <div class="arrow-two"></div>
                                                        <div class="title">{{ $article['source']['name'] ?? '' }}</div>
                                                        @php($title = $article['title'] ?? '')
                                                        @php($title = strlen($title) > 48 ? substr($title,0,45) . '...' : $title)
                                                        <h4><a href="{{ $article['url'] }}" target="_blank">{{ $title }}</a></h4>
                                                        <div class="post-date">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('F jS, Y') }} by <span>Admin</span></div>
                                                    </div>
                                                </div>
                                                <!-- Image Column -->
                                                <div class="image-column col-lg-6 col-md-6 col-sm-12 order-lg-2 order-1">
                                                    <div class="inner-column">
                                                        <div class="image">
                                                            <a href="{{ $article['url'] }}" target="_blank"><img style="width: 390px; height: 390px;" src="{{ $article['urlToImage'] }}" alt="" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @php($displayedArticles[] = $article['url'])
                                @php($count++)
                            @endif
                        @endforeach
                    @endif
                </div>

                <!-- Column for the third article -->
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    @if(isset($newsData['articles']))
                        @php($thirdArticleFound = false)
                        @foreach($newsData['articles'] as $index => $article)
                            @if(!empty($article['urlToImage']) && !$thirdArticleFound && !in_array($article['url'], $displayedArticles))
                                <!-- News Block Two -->
                                <div class="news-block-two">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="{{ $article['url'] }}" target="_blank"><img style="width: 390px; height: 390px;" src="{{ $article['urlToImage'] }}" alt="" /></a>
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="lower-content">
                                            <div class="title">{{ $article['source']['name'] ?? '' }}</div>
                                            @php($title = $article['title'] ?? '')
                                            @php($title = strlen($title) > 48 ? substr($title,0,45) . '...' : $title)
                                            <h4><a href="{{ $article['url'] }}" target="_blank">{{ $title }}</a></h4>
                                            <div class="post-date">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('F jS, Y') }} by <span>Admin</span></div>
                                        </div>
                                    </div>
                                </div>
                                @php($displayedArticles[] = $article['url'])
                                @php($thirdArticleFound = true)
                            @endif
                        @endforeach
                    @endif
                </div>

                @if($newsData === null)
                    <p class="text-center">No news available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</section>
