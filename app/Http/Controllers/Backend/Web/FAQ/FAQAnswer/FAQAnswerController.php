<?php


namespace App\Http\Controllers\Backend\Web\FAQ\FAQAnswer;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\FAQ\FAQAnswer\StoreFAQAnswerRequest;
use App\Http\Requests\Backend\Web\FAQ\FAQAnswer\UpdateFAQAnswerRequest;
use App\Repositories\Backend\FAQ\FAQAnswer\FAQAnswerRepositoryContract;
use App\Repositories\Backend\FAQ\FAQQuestion\FAQQuestionRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FAQAnswerController extends Controller
{
    private $FAQAnswerRepositoryContract;
    private $FAQQuestionRepositoryContract;

    public function __construct(
        FAQAnswerRepositoryContract $FAQAnswerRepositoryContract,
        FAQQuestionRepositoryContract $FAQQuestionRepositoryContract
    )
    {
        $this->middleware('FAQAnswer.can-list', ['only' => ['index']]);
        $this->middleware('FAQAnswer.can-show', ['only' => ['show']]);
        $this->middleware('FAQAnswer.can-create', ['only' => ['create', 'store', 'upload']]);
        $this->middleware('FAQAnswer.can-edit', ['only' => ['edit', 'update','upload']]);
        $this->middleware('FAQAnswer.can-delete', ['only' => ['destroy']]);

        $this->FAQAnswerRepositoryContract=$FAQAnswerRepositoryContract;
        $this->FAQQuestionRepositoryContract=$FAQQuestionRepositoryContract;
    }

    public function index($FAQQuestion_id)
    {
        $FAQAnswers = $this->FAQAnswerRepositoryContract->paginate();
        return view('backend.faq.faqAnswer.index', compact('FAQAnswers'));
    }

    public function show($FAQQuestion_id, $id)
    {
        $FAQAnswer = $this->FAQAnswerRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.FAQQuestions.FAQAnswers.show', $FAQQuestion_id, $FAQAnswer);
        return view('backend.faq.faqAnswer.show', compact('FAQAnswer'));
    }

    public function edit($FAQQuestion_id, $id)
    {
        $FAQAnswer = $this->FAQAnswerRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.FAQQuestions.FAQAnswers.edit',$FAQQuestion_id, $FAQAnswer);
        return view('backend.faq.faqAnswer.edit', compact('FAQAnswer', 'FAQQuestion_id'));
    }

    public function update(UpdateFAQAnswerRequest $request, $FAQQuestion_id, $id)
    {
        $data = $this->FAQAnswerRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.FAQQuestions.show', $FAQQuestion_id);
    }

    public function create($FAQQuestion_id)
    {
        $FAQQuestion=$this->FAQQuestionRepositoryContract->findById($FAQQuestion_id);
        $FAQQuestion_name=$FAQQuestion->title;
        return view('backend.faq.faqAnswer.create', compact('FAQQuestion_name', 'FAQQuestion_id'));
    }

    public function store(StoreFAQAnswerRequest $request, $FAQQuestion_id)
    {
        $data=$request->validated();
        $data = $this->FAQAnswerRepositoryContract->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.FAQQuestions.show', $FAQQuestion_id);
    }

    public function destroy($FAQQuestion_id, $id)
    {
        try {
            $data = $this->FAQAnswerRepositoryContract->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.FAQQuestions.show', $FAQQuestion_id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.FAQQuestions.show', $FAQQuestion_id);
        }
    }
    public function upload(Request $request, $FAQQuestion_id)
    {
        $message='';
        $response='';
        $validator = Validator::make($request->all(),
            [
                'upload' => 'required|file|image|max:10240',
                'CKEditorFuncNum'=>'required',
            ]
        );

        if ($validator->fails()){
            $errors = $validator->errors();
            foreach ($errors->all() as $item) {
                $message .= $item."\\n";
            }
            $response = "<script>alert('$message')</script>";
        }elseif ($request->hasFile('upload')) {
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('imgs/FAQ/'), $fileName);
            $url = asset('imgs/FAQ/'.$fileName);
            $msg = 'Изображение успешно загружено!';
            $response = "<script>alert('$msg')</script>";

            $response = "<script>window.parent.CKEDITOR.tools.callFunction('$CKEditorFuncNum', '$url', '$msg')</script>";
        }
        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
}