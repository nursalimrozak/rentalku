@extends('layouts.app')
@section('header-class', 'header-one')

@section('content')

<!-- Breadscrumb Section -->
<div class="blogbanner" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : asset('admin_assets/images/car-01.jpg') }}'); background-size: cover; background-position: center;">		   
    <div class="blogbanner-content">
       <span class="blog-hint">{{ $article->category }}</span>
       <h1>{{ $article->title }}</h1>
       <ul class="entry-meta meta-item justify-content-center">
           <li>
               <div class="post-author">
                   <div class="post-author-img">
                       <img src="{{ asset('admin_assets/images/avatar-01.jpg') }}" alt="author">
                   </div>
                   <a href="javascript:void(0)"><span> Admin </span></a>
               </div>
           </li>
           <li class="date-icon"><i class="fa-solid fa-calendar-days"></i> {{ $article->published_at ? $article->published_at->format('F d, Y') : 'N/A' }}</li>
       </ul>
   </div>		            
</div>	
<!-- /Breadscrumb Section -->	

<!-- Blog Grid-->
<div class="blog-section">
    <div class="container">
        
        <!-- Main Content -->
        <div class="blog-description">
            {!! $article->content !!}
        </div>
        
        <!-- Additional Description (Static/Placeholder if needed, or removed if all content is in one block) 
             The user had Lorem Ipsum here. I will remove the extra lorem ipsum blocks 
             so the actual article content shines. -->

        <!-- Inner Images Row (Only showing if we want fixed structure, or maybe relying on content images)
             User had static images here. I will convert this to show images if the article has them, 
             or just keep it as a static gallery placeholder for now to match their layout request?
             I'll comment it out or leave one as example if they really want the layout structure.
             For now, I'll assume the Summernote content contains the images and text.
             But I will keep the social share section. -->
        
        <div class="share-postsection">
             <div class="row">
                <div class="col-lg-4">
                    <div class="sharelink d-flex align-items-center">
                       <a href="javascript:void(0);" class="share-img"><i class="feather-share-2"></i></a>
                       <a href="javascript:void(0);" class="share-text">Share</a>
                    </div>
                </div>				 
             </div>
        </div>

        <!-- Pagination -->
        <div class="blogdetails-pagination">
            <ul>
                <li>
                    @if($previousArticle)
                        <a href="{{ route('public.articles.show', $previousArticle->slug) }}" class="prev-link"><i class="fas fa-regular fa-arrow-left"></i> Previous Post</a>
                        <a href="{{ route('public.articles.show', $previousArticle->slug) }}"><h3>{{ $previousArticle->title }}</h3> </a>
                    @endif
                </li>
                <li>
                    @if($nextArticle)
                        <a href="{{ route('public.articles.show', $nextArticle->slug) }}" class="next-link">Next Post <i class="fas fa-regular fa-arrow-right"></i> </a>
                        <a href="{{ route('public.articles.show', $nextArticle->slug) }}"><h3>{{ $nextArticle->title }}</h3> </a>
                    @endif
                </li>						
            </ul>				
        </div>	
      
    </div>					   
</div>	
<!-- /Blog Grid-->	

@endsection

@push('styles')
<style>
    /* Ensure content images are responsive */
    .blog-description img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    /* Overlay for blog banner to make text readable */
    .blogbanner {
        position: relative;
        display: flex;
        align-items: flex-end; /* Align content to bottom */
        height: 60vh; /* Ensure banner has height */
        padding-bottom: 50px; /* Space from bottom edge */
    }
    .blogbanner::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Dark overlay */
        z-index: 1;
    }
    .blogbanner-content {
        position: relative;
        z-index: 2;
        width: 100%;
        text-align: center; /* Center text horizontally */
    }
    .blogbanner h1, .blogbanner span, .blogbanner li, .blogbanner i {
        color: #fff !important;
    }
</style>
@endpush
