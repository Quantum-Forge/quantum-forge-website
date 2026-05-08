<div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                	<aside class="sidebar sticky-top">

                        @php
                            $sidebarCategories = \App\Models\Category::withCount('articles')->having('articles_count', '>', 0)->get();
                            $totalArticles = \App\Models\Article::count();
                            $recentPosts = \App\Models\Article::latest()->take(3)->get();
                            $softwareHouseTags = [
                                'Software House', 'Web Development', 'Mobile Apps',
                                'UI/UX Design', 'IT Consultant', 'Digital Transformation',
                                'AI Solutions', 'SEO'
                            ];
                        @endphp

						<!-- Search -->
                        <div class="sidebar-widget search-box">
							<div class="sidebar-title">
                            	<h4>Search</h4>
                            </div>
                        	<form method="GET" action="{{ route('articles') }}">
                                <div class="form-group">
                                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Type & Hit Enter..." required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
						</div>

						<!--Category Blog-->
                        <div class="sidebar-widget categories-blog">
                        	<div class="sidebar-title">
                            	<h4>Categories</h4>
                            </div>
                            <ul>
								<li><a href="{{ route('articles') }}">All <span>{{ $totalArticles }}</span></a></li>
                                @foreach($sidebarCategories as $cat)
								<li><a href="#">{{ $cat->name }} <span>{{ $cat->articles_count }}</span></a></li>
                                @endforeach
							</ul>
                        </div>

						<!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
							<div class="sidebar-title">
                            	<h4>Recent Posts</h4>
                            </div>
                            <div class="widget-content">
                                @foreach($recentPosts as $post)
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{ route('articles.details', $post->slug) }}">
                                        @if($post->image_url)
                                            <img src="{{ asset('storage/' . $post->image_url) }}" alt="{{ $post->title }}">
                                        @else
                                            <img src="https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg" alt="{{ $post->title }}">
                                        @endif
                                    </a></figure>
                                    <div class="text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><a href="{{ route('articles.details', $post->slug) }}">{{ $post->title }}</a></div>
                                </div>
                                @endforeach
                            </div>
						</div>

						<!-- Tags -->
                        <div class="sidebar-widget tags">
							<div class="sidebar-title">
                            	<h4>Tags</h4>
                            </div>
							<div class="widget-content">
                                @foreach($softwareHouseTags as $tag)
								<a href="#">{{ $tag }}</a>
                                @endforeach
							</div>
						</div>

					</aside>
				</div>
