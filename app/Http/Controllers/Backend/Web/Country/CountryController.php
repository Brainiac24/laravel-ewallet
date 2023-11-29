<?php

namespace App\Http\Controllers\Backend\Web\Country;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use Illuminate\Http\Request;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Http\Requests\Backend\Web\Country\StoreCountryRequest;
use App\Http\Requests\Backend\Web\Country\UpdateCountryRequest;
use App\Services\Common\Helpers\Events;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;

class CountryController extends Controller
{
    /**
     * @var CountryRepositoryContract
     */
    private $countryRepositoryContract;

    /**
     * Display a listing of the resource.
     *
     * @param CountryRepositoryContract $countryRepositoryContract
     */
    public function __construct(CountryRepositoryContract $countryRepositoryContract)
    {

        $this->countryRepositoryContract = $countryRepositoryContract;
        $this->middleware('country.can-list', ['only' => ['index']]);
        $this->middleware('country.can-show', ['only' => ['show']]);
        $this->middleware('country.can-create', ['only' => ['create','store']]);
        $this->middleware('country.can-edit', ['only' => ['edit','update']]);
        $this->middleware('country.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        $data = $this->countryRepositoryContract->paginate();
        return view('backend.country.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        //
        $country = $this->countryRepositoryContract->create($request->validated());
        $country->setChanges($country->getAttributes());
        event(new UserModifiedEvent($country, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = $this->countryRepositoryContract->findById($id);
        //dd($country->id);
        Breadcrumbs::setCurrentRoute('admin.countries.show', $country);
        return view('backend.country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = $this->countryRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.countries.edit', $country);
        return view('backend.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        $country = $this->countryRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($country, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $country = $this->countryRepositoryContract->destroy($id);
            event(new UserModifiedEvent($country, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_disable'));
            return redirect()->route('admin.countries.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.countries.index');
        }
    }
}
