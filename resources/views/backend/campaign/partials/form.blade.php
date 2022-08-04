@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header>{!! $header !!}</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($campaign->name) ? $campaign->name : '') }}"/>

                                <label for="Name">Name</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="alias" class="form-control" required
                                       value="{{ old('alias', isset($campaign->alias) ? $campaign->alias : '') }}"/>

                                <label for="Name">Alias</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('alias') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="details" class="form-control" required
                                       value="{{ old('details', isset($campaign->details) ? $campaign->details : '') }}"/>

                                <label for="Name">Details</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('details') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="success_message" class="form-control" required
                                       value="{{ old('success_message', isset($campaign->success_message) ? $campaign->success_message : '') }}"/>

                                <label for="Name">Success Message</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('success_message') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="sms_message" class="form-control" required
                                       value="{{ old('sms_message', isset($campaign->sms_message) ? $campaign->sms_message : '') }}"/>

                                <label for="Name">SMS Message</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('sms_message') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="url" class="form-control" required
                                       value="{{ old('url', isset($campaign->url) ? $campaign->url : '') }}"/>

                                <label for="Name">URL</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('url') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="keywords" class="form-control" required
                                       value="{{ old('keywords', isset($campaign->keywords) ? $campaign->keywords : '') }}"/>

                                <label for="Name">Keywords</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('keywords') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="date" name="starts" class="form-control" required
                                       value="{{ old('starts', isset($campaign->starts) ? $campaign->starts : '') }}"/>

                                <label for="starts">Starts</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('starts') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="date" name="ends" class="form-control" required
                                       value="{{ old('ends', isset($campaign->ends) ? $campaign->ends : '') }}"/>

                                <label for="ends">Ends</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('ends') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Coupen Codes</strong>
                                <textarea name="coupon_codes" id=""
                                          class="ckeditor">{{old('coupon_codes',isset($campaign->coupon_codes)?$campaign->coupon_codes : '')}}</textarea>

                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                <textarea name="description" id=""
                                          class="ckeditor">{{old('description',isset($campaign->description)?$campaign->description : '')}}</textarea>

                            </div>
                        </div>


                    </div>

                    <div class="row" id="imageupload">
                            <div class="col-sm-12">
                                <label class="text-default-light">Banner Image</label>
                                @if(isset($campaign) && $campaign->banner)
                                    <input type="file" name="banner" class="dropify"
                                        data-default-file="{{ asset($campaign->thumbnail_path)}}"/>
                                @else
                                    <input type="file" name="banner" class="dropify"/>
                                @endif
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="" data-spy="affix" data-offset-top="50">
            <div class="panel-group" id="accordion1">
                <div class="card panel expanded">
                    <div class="card-head" data-toggle="collapse" data-parent="#accordion1" data-target="#accordion1-1">
                        <header>Publish</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-1" class="collapse in">

                        <div class="card-head">
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Status</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="status"
                                           {{ old('status', isset($campaign->status) ? $campaign->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            {{-- <div class="side-label">
                                <div class="label-head">
                                    <span>Status</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="is_status"
                                           {{ old('is_status', isset($campaign->is_status) ? $campaign->is_status : '')=='1' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div> --}}
                        </div>

                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a class="btn btn-default btn-ink" href="{{ route('campaign.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-info ink-reaction" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->

                <!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
            </div><!--end .panel-group -->
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
@endsection
