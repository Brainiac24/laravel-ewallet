<?php


namespace App\Http\Controllers\Backend\Web\FAQ\FAQQuestion;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\FAQ\FAQQuestion\StoreFAQQuestionRequest;
use App\Http\Requests\Backend\Web\FAQ\FAQQuestion\UpdateFAQQuestionRequest;
use App\Repositories\Backend\FAQ\FAQAnswer\FAQAnswerRepositoryContract;
use App\Repositories\Backend\FAQ\FAQQuestion\FAQQuestionRepositoryContract;
use App\Services\Common\Helpers\Events;

class FAQQuestionController extends Controller
{
    private $FAQQuestionRepositoryContract;
    private $FAQAnswerRepositoryContract;

    public function __construct(
        FAQQuestionRepositoryContract $FAQQuestionRepositoryContract,
        FAQAnswerRepositoryContract $FAQAnswerRepositoryContract
    )
    {
        $this->middleware('FAQQuestion.can-list', ['only' => ['index']]);
        $this->middleware('FAQQuestion.can-show', ['only' => ['show']]);
        $this->middleware('FAQQuestion.can-create', ['only' => ['create', 'store']]);
        $this->middleware('FAQQuestion.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('FAQQuestion.can-delete', ['only' => ['destroy']]);

        $this->FAQQuestionRepositoryContract=$FAQQuestionRepositoryContract;
        $this->FAQAnswerRepositoryContract=$FAQAnswerRepositoryContract;
    }

    public function index()
    {
        $FAQQuestions = $this->FAQQuestionRepositoryContract->paginate();
        return view('backend.faq.faqQuestion.index', compact('FAQQuestions'));
    }

    public function show($id)
    {
        $FAQQuestion = $this->FAQQuestionRepositoryContract-> findById($id);
        $FAQQuestionParent=$this->FAQQuestionRepositoryContract->findById($FAQQuestion->id);
        $FAQAnswers=$this->FAQAnswerRepositoryContract->GetAllByFAQQuestionId($id);

        \Breadcrumbs::setCurrentRoute('admin.FAQQuestions.show', $FAQQuestion);
        return view('backend.faq.faqQuestion.show', compact('FAQQuestion', 'FAQQuestionParent','FAQAnswers'));
    }

    public function edit($id)
    {
        $FAQQuestion = $this->FAQQuestionRepositoryContract->findById($id);
        $FAQQuestionList=$this->FAQQuestionRepositoryContract
            ->all()
            ->pluck('title','id')
            ->prepend('','00000000-0000-0000-0000-000000000000');
        $FAQQuestionList->pull($FAQQuestion->id);
        \Breadcrumbs::setCurrentRoute('admin.FAQQuestions.edit', $FAQQuestion);
        return view('backend.faq.faqQuestion.edit', compact('FAQQuestion', 'FAQQuestionList'));
    }

    public function update(UpdateFAQQuestionRequest $request, $id)
    {
        $data = $this->FAQQuestionRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.FAQQuestions.index');
    }

    public function create()
    {
        $FAQQuestionList=$this->FAQQuestionRepositoryContract
            ->all()
            ->pluck('title','id')
            ->prepend('','00000000-0000-0000-0000-000000000000');
        return view('backend.faq.faqQuestion.create', compact('FAQQuestionList'));
    }

    public function store(StoreFAQQuestionRequest $request)
    {
        $data = $this->FAQQuestionRepositoryContract->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.FAQQuestions.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->FAQQuestionRepositoryContract->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.FAQQuestions.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.FAQQuestions.index');
        }
    }
}