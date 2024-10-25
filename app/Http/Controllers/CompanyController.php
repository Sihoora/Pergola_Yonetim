<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    //
    public function create()
    {
        return view('admin.include.companies.company_create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'required|string|max:50',
            'tax_id' => 'nullable|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'contact_person' => 'nullable|string|max:50',
            'contact_phone' => 'nullable|string|max:50',
        ]);


        $company = new Company();
        $company->company_name = $validatedData['company_name'];
        $company->phone = $validatedData['phone'];
        $company->email = $validatedData['email'];
        $company->tax_id = $validatedData['tax_id'];
        $company->address = $validatedData['address'];
        $company->city = $validatedData['city'];
        $company->contact_person = $validatedData['contact_person'];
        $company->contact_phone = $validatedData['contact_phone'];
        $company->save();
                
        return redirect()->route('company-create')->with('success', 'Şirket başarıyla eklendi.');

    }

    public function edit($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return redirect()->back()->with('error', 'Şirket bulunamadı.');
        }

        return view('admin.include.companies.company_create', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return redirect()->back()->with('error', 'Şirket bulunamadı.');
        }

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'required|string|max:50',
            'tax_id' => 'nullable|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'contact_person' => 'nullable|string|max:50',
            'contact_phone' => 'nullable|string|max:50',
        ]);

        $company->company_name = $validatedData['company_name'];
        $company->phone = $validatedData['phone'];
        $company->email = $validatedData['email'];
        $company->tax_id = $validatedData['tax_id'];
        $company->address = $validatedData['address'];
        $company->city = $validatedData['city'];
        $company->contact_person = $validatedData['contact_person'];
        $company->contact_phone = $validatedData['contact_phone'];
        $company->save();

        return redirect()->route('company-edit', $company->id)->with('success', 'Şirket başarıyla güncellendi.');
    }

    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return redirect()->back()->with('error', 'Şirket bulunamadı.');
        }

        return view('admin.include.companies.company_detail', compact('company'));
    }

    public function company_list()
    {
        $companies = Company::all();
        return view("admin.include.companies.companies_list", compact("companies"));
    }

    
 

}
