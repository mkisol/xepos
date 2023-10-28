<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\{StoreCompanyRequest, UpdateCompanyRequest};
use Yajra\DataTables\Facades\DataTables;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use Image;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:company view')->only('index', 'show');
        $this->middleware('permission:company create')->only('create', 'store');
        $this->middleware('permission:company edit')->only('edit', 'update');
        $this->middleware('permission:company delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $companies = Company::query();

            return Datatables::of($companies)
                
                ->addColumn('logo', function ($row) {
                    if ($row->logo == null) {
                    return 'https://via.placeholder.com/350?text=No+Image+Avaiable';
                }
                    return asset('storage/app/public/uploads/logos/' . $row->logo);
                })

                ->addColumn('action', 'companies.include.action')
                ->toJson();
        }

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $attr = $request->validated();
        
        if ($request->file('logo') && $request->file('logo')->isValid()) {

            $path = storage_path('app/public/uploads/logos/');
            $filename = $request->file('logo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('logo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
				$constraint->aspectRatio();
            })->save($path . $filename);

            $attr['logo'] = $filename;
        }

        Company::create($attr);

        //Sending Email
        Mail::to($attr['email'])->send(new Email);

        if (Mail::failures() != 0) {
            return redirect()
            ->route('companies.index')
            ->with('success', __('The company was created successfully and Email is sent to provided Email.'));
        }
        
        return redirect()
            ->route('companies.index')
            ->with('success', __('The company was created successfully, but Email is not sent to provided Email.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $attr = $request->validated();
        
        if ($request->file('logo') && $request->file('logo')->isValid()) {

            $path = storage_path('app/public/uploads/logos/');
            $filename = $request->file('logo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('logo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
				$constraint->aspectRatio();
            })->save($path . $filename);

            // delete old logo from storage
            if ($company->logo != null && file_exists($path . $company->logo)) {
                unlink($path . $company->logo);
            }

            $attr['logo'] = $filename;
        }

        $company->update($attr);

        return redirect()
            ->route('companies.index')
            ->with('success', __('The company was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            $path = storage_path('app/public/uploads/logos/');

            if ($company->logo != null && file_exists($path . $company->logo)) {
                unlink($path . $company->logo);
            }

            $company->delete();

            return redirect()
                ->route('companies.index')
                ->with('success', __('The company was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('companies.index')
                ->with('error', __("The company can't be deleted because it's related to another table."));
        }
    }
}
