<div class="tab-pane p-3 active" id="program" role="tabpanel">

    <div class="row">
        <div class="col-md-4">

            <div class="form-group ">
                <label for="title" class="col-form-label pt-0">Program Title</label>
                <div class="">
                    <input class="form-control" type="text" required name="title"
                        value="{{ old('title', isset($program->title) ? $program->title : '') }}"
                        placeholder="Enter Program Title">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <label class="control-label">Select Documents</label>
            <div class="d-flex">
                <input id="thumbnail" class="form-control" type="text" name="checklist_documents" readonly>
                <button id="lfm" data-input="thumbnail" data-preview="holder"
                    class="lfm btn btn-icon icon-left btn-primary ml-2 d-flex">
                    <i class="fa fa-upload"></i> &nbsp;Choose
                </button>
            </div>
        </div>

        <div class="col-sm-4">
            <label class="control-label">Choose Image</label>
            <div class="d-flex">
                <input id="thumbnail1" class="form-control" type="text" name="image" readonly>
                <button id="lfm1" data-input="thumbnail1" data-preview="holder1"
                    class="lfm btn btn-icon icon-left btn-primary ml-2 d-flex">
                    <i class="fa fa-upload"></i> &nbsp;Choose
                </button>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <strong>Description</strong>
                <textarea name="description" id="" class="ckeditor">{{ old('description', isset($program->description) ? $program->description : '') }}</textarea>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group ">
                <label for="contact_person" class="col-form-label pt-0">Contact Person Name</label>
                <div class="">
                    <input class="form-control" type="text" required name="contact_person"
                        value="{{ old('contact_person', isset($program->contact_person) ? $program->contact_person : '') }}"
                        placeholder="Enter Contact Person Name">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                <label for="contact_email" class="col-form-label pt-0">Contact Person Email</label>
                <div class="">
                    <input class="form-control" type="text" required name="contact_email"
                        value="{{ old('contact_email', isset($program->contact_email) ? $program->contact_email : '') }}"
                        placeholder="Enter Contact Person Email">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                <label for="contact_number" class="col-form-label pt-0">Contact Person Number</label>
                <div class="">
                    <input class="form-control" type="text" required name="contact_number"
                        value="{{ old('contact_number', isset($program->contact_number) ? $program->contact_number : '') }}"
                        placeholder="Enter Contact Person Number">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <strong>Special Instructions</strong>
                <textarea name="special_instruction" id="" class="ckeditor">{{ old('special_instruction', isset($program->special_instruction) ? $program->description : '') }}</textarea>

            </div>
        </div>


    </div>
</div>
