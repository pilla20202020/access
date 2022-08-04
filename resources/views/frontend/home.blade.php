@extends('frontend.layouts.app')

@section('content')

  <!-- START SECTION PROJECT -->
  @if ($blogs->isNotEmpty())
  <section class="small_pt">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-xl-6 col-lg-8">
                  <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                      <div class="heading_s1 text-center">
                          <h2>Blogs</h2>
                      </div>
                    
                  </div>
              </div>
          </div>
      </div>
 

      <div class="container">	
           
          <div class="row">
              <div class="col-md-12">
                  <ul class="grid_container gutter_medium grid_col3">
                      <li class="grid-sizer"></li>
                      <!-- START PORTFOLIO ITEM -->
                      @foreach ($blogs as $blogsData)
                      <li class="grid_item">
                          <div class="gallery_item">
                              <div class="content_box event_box radius_all_10 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                                  
                                  <div class="content_desc">
                                      <h4 class="content_title"><a href="#"><span> {{ $blogsData->title }}</span></a></h4>
                                         
                                          <span>{!! Str::limit($blogsData->content, 200) !!}</span>
                                      </h4>
                                  </div>
                              </div>
                             
                          </div>
                      </li>
                      @endforeach
                      <!-- END PORTFOLIO ITEM -->
                      
                  </ul>
              </div>
          </div>
      </div>
  </section>
@endif 
<!-- START SECTION PROJECT -->

    
@stop