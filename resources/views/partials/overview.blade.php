	<!--overview -->
	<section id="gallery" class="overview">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="overview-content">
						<div class="overview-txt">

							@foreach ($home as $h)
								
							
							<h2>
								@if(app()->getLocale()=='ru')
								{{ __($h->title_am) }}
								@elseif(app()->getLocale()=='hy')
								{{ __($h->title_ru) }}
								@else
								{{ __($h->title) }}
								@endif
								{{-- <p>
									{{  __('Welcome to our website')}}
								</p> --}}
							</h2>
							<p>
								@if(app()->getLocale()=='ru')
								{{ __($h->subtitle_am) }}
								@elseif(app()->getLocale()=='hy')
								{{ __($h->subtitle_ru) }}
								@else
								{{ __($h->subtitle) }}
								@endif
							</p>
							@endforeach
						</div>
						<!--/.overview-txt-->
					</div>
					<!--/.overview-content-->
				</div>
				<!--/.col-->
			</div>
			<!--/.row-->
		</div>
		<!--/.container-->

	</section>
