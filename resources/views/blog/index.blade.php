@extends('layouts.app')
@section('header-class', 'header-one')

@section('content')

<!-- Breadscrumb Section -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">List Artikel</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Artikel</li>
                    </ol>
                </nav>							
            </div>
        </div>
    </div>
</div>
<!-- /Breadscrumb Section -->	

<!-- Blog Grid-->
<div class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @forelse($articles as $article)
                    <div class="col-lg-6 col-md-6 d-lg-flex">
                        <div class="blog grid-blog flex-fill"> 
                            <div class="blog-image">
                                <a href="#">
                                    @if($article->image)
                                        <img class="img-fluid" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" style="height: 250px; width: 100%; object-fit: cover;">
                                    @else
                                        <img class="img-fluid" src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="Placeholder">
                                    @endif
                                </a>
                            </div>
                            <div class="blog-content">
                                <p class="blog-category">
                                    <a href="javascript:void(0)"><span>{{ $article->category }}</span></a>
                                </p>
                                <h3 class="blog-title"><a href="#">{{ $article->title }}</a></h3>
                                <p class="blog-description">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                <ul class="meta-item">
                                    <li>
                                        <div class="post-author">
                                            <div class="post-author-img">
                                                <img src="{{ asset('admin_assets/images/avatar-01.jpg') }}" alt="author"> 
                                            </div>
                                            <a href="javascript:void(0)"> <span> Admin </span></a>
                                        </div>
                                    </li>
                                    <li class="date-icon"><i class="fa-solid fa-calendar-days"></i> <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : 'N/A' }}</span></li>
                                </ul>
                                <a href="#" class="viewlink btn btn-primary">Read More <i class="feather-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="text-center">No articles found.</p>
                    </div>
                    @endforelse
                </div>
                
                <!--Pagination--> 
                <div class="pagination">
                    <nav>
                             {{ $articles->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
                <!--/Pagination-->
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4 theiaStickySidebar">
                <div class="rightsidebar">
                    <div class="card">
                        <h4><i class="feather-list me-2 text-primary"></i> Categories</h4> <!-- Fixed missing icon -->
                        <ul class="blogcategories-list">
                            @forelse($categories as $category)
                                <li><a href="javascript:void(0)">{{ $category }}</a></li>
                            @empty
                                <li><a href="javascript:void(0)">No categories</a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card mb-0">
                        <h4><i class="feather-tag me-2 text-primary"></i>Top Article</h4>
                        
                        @forelse($topArticles as $topArticle)
                        <div class="article">
                            <div class="article-blog">
                                <a href="#">
                                    @if($topArticle->image)
                                        <img class="img-fluid" src="{{ asset('storage/' . $topArticle->image) }}" alt="{{ $topArticle->title }}">
                                    @else
                                        <img class="img-fluid" src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="Placeholder">
                                    @endif
                                </a>
                            </div>
                            <div class="article-content">
                                <h5><a href="#">{{ $topArticle->title }}</a></h5>
                                <div class="article-date">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span>{{ $topArticle->published_at ? $topArticle->published_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>	
                        @empty
                            <p>No top articles.</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>				   
    </div>	
</div>
<!-- /Blog Grid-->

@endsection

@push('styles')
<style>
    /* Pagination adjustments to match template if needed */
    .pagination-area .page-link {
        color: #333;
    }
    .pagination-area .page-item.active .page-link {
        background-color: #FF9F00;
        border-color: #FF9F00;
        color: #fff;
    }
</style>
@endpush