<?php

namespace App\Http\Controllers\DocumentChecklist;

use App\Http\Controllers\Controller;
use App\Modules\Models\CheckedListItem\CheckedListItem;
use App\Modules\Models\DocumentationChecklist\DocumentationChecklist;
use App\Modules\Models\Qualification\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentChecklistController extends Controller
{
    protected $document_checklist, $qualification, $checklistitem;

    function __construct(DocumentationChecklist $document_checklist, Qualification $qualification, CheckedListItem $checklistitem)
    {
        $this->document_checklist = $document_checklist;
        $this->qualification = $qualification;
        $this->checklistitem = $checklistitem;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $document_checklists = $this->document_checklist->get();
        return view('documents_checklist.index', compact('document_checklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $qualifications = $this->qualification->all();

        return view('documents_checklist.create', compact('qualifications'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $document = $request->all();
            $document_checklist = DB::transaction(function () use ($document) {
                $documentData = [
                    'checklist_for' => $document['checklist_for'],
                    'checklist_name' => $document['checklist_name'],
                ];
                $documentschecklist = $this->document_checklist->create($documentData);

                // documentSamplePath Language
                // $documentsPath = [];
                // if (!empty($document['document_sample'])) {
                //     foreach ($document['document_sample'] as $value) {
                //         $documentsPath[] = uploadCommonFile($value, 'checklist_documents/');
                //     }
                // }

                if (!empty($document['document_name'])) {
                    foreach ($document['document_name'] as  $key => $value) {
                        if(isset($value)) {
                            $files = [
                                'documentation_id' => $documentschecklist->id,
                                'document_name' => $document['document_name'][$key] ?? null,
                                'document_sample' => $document['document_sample'][$key] ?? null,
                            ];
                            // dd($quali);
                            CheckedListItem::create($files);
                        }

                    }
                }

            });

            Toastr()->success('Document Check List Created Successfully','Success');
            return redirect()->route('document_checklist.index');
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $document_checklist = $this->document_checklist->where('id',$id)->first();
        $qualifications = $this->qualification->all();

        return view('documents_checklist.edit', compact('document_checklist','qualifications'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        dd($request->all());
        try {
            $data = $request->all();
            $document_checklist = DB::transaction(function () use ($data, $id) {
                $documents = $this->document_checklist->where('id',$id);
                $documentData = [
                    'checklist_for' => $data['checklist_for'],
                    'checklist_name' => $data['checklist_name'],
                ];

                $documents->update($documentData);
                $documentschecklist = $documents->first();
                // documentSamplePath Language
                $documentsPath = [];

                if(!empty($data['document_sample'])) {
                    foreach ($data['document_sample'] as $key => $value) {
                        if(!empty($data['checklist_id'][$key])){
                            $existingQuli = CheckedListItem::find($data['checklist_id'][$key]);
                            if($existingQuli){
                                $documentsPath[] = $existingQuli->document_sample;
                            }
                        }
                        $documentsPath[$key] = $data['document_sample'][$key];


                    }
                }

                if (!empty($data['document_name'])) {
                    foreach ($data['document_name'] as  $key => $value) {
                        if($value != null) {
                            $files = [
                                'documentation_id' => $documentschecklist->id,
                                'document_name' => $data['document_name'][$key],
                            ];

                            if(isset($documentsPath[$key])){
                                $files['document_sample'] = $documentsPath[$key];
                            }
                            if(!empty($data['checklist_id'][$key])){
                                $existingQuli = CheckedListItem::find($data['checklist_id'][$key]);
                                if($existingQuli){
                                    $existingQuli->update($files);
                                }
                            }else{
                                CheckedListItem::create($files);
                            }
                        }

                    }
                }

            });

            Toastr()->success('Document Check List is Updated Successfully','Success');
            return redirect()->route('document_checklist.index');
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $document_checklist = $this->document_checklist->where('id',$id);
        $document = $document_checklist->first();
        foreach($document->checklists as $list) {
            $checklistitem = $this->checklistitem->where('id',$list->id);
            if (is_file(public_path().'/storage/'. $checklistitem->first()->document_sample)) {
                $imageFile = public_path().'/storage/'. $checklistitem->first()->document_sample;
                unlink($imageFile);
            }
        }
        $document_checklist->delete();
        Toastr()->success('Document Checklist has been deleted successfully','Success');
        return redirect()->route('document_checklist.index')->withSuccess(trans('Student has been deleted'));
    }

    public function deleteCheckList($id) {

        try {
            $checklistitem = $this->checklistitem->where('id',$id);
            if (is_file(public_path().'/storage/'. $checklistitem->first()->document_sample)) {
                $imageFile = public_path().'/storage/'. $checklistitem->first()->document_sample;
                unlink($imageFile);
            }
            if($checklistitem = $checklistitem->delete()) {
                Toastr()->success('CheckList Item has been deleted successfully','Success');
                return redirect()->back();
            } else {
                Toastr()->error('CheckList Item cannot be deleted at the moment','Error');
                return redirect()->back();
            }

        } catch (Exception $e) {
            return false;
        }

    }

    public function replicate($id) {
        $document_checklist = $this->document_checklist->where('id',$id)->first();
        $newDocument = $document_checklist->replicate();
        $newDocument->save();
        if (isset($document_checklist->checklists) && $document_checklist->checklists->isEmpty() == false) {
            foreach($document_checklist->checklists as $list) {
                $newlistitem = $list->replicate();
                $newlistitem->documentation_id= $newDocument->id;
                $newlistitem->save();
            }
        }

        Toastr()->success('Replicate checklist created Successfully','Success');
        return redirect()->back();
    }

}
