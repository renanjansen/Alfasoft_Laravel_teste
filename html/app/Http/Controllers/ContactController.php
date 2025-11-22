<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Services\CountryService;

class ContactController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
        $this->middleware('auth')->except(['show']);
    }

    public function create($personId)
    {
        $person = Person::findOrFail($personId);
        $countries = $this->countryService->getCountriesForDropdown();

        return view('contacts.create', compact('person', 'countries'));
    }

    public function store(StoreContactRequest $request)
    {
        try {
            Contact::create($request->validated());

            return redirect()->route('people.show', $request->person_id)
                ->with('success', 'Contacto adicionado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar contacto: ' . $e->getMessage());
        }
    }

    public function show(Contact $contact)
    {
        $contact->load('person');
        $countryName = $this->countryService->getCountryNameByCode($contact->country_code);
        return view('contacts.show', compact('contact', 'countryName'));
    }

    public function edit(Contact $contact)
    {
        $countries = $this->countryService->getCountriesForDropdown();
        return view('contacts.edit', compact('contact', 'countries'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try {
            $contact->update($request->validated());

            return redirect()->route('people.show', $contact->person_id)
                ->with('success', 'Contacto atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar contacto: ' . $e->getMessage());
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $personId = $contact->person_id;
            $contact->delete();

            return redirect()->route('people.show', $personId)
                ->with('success', 'Contacto eliminado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao eliminar contacto: ' . $e->getMessage());
        }
    }
}
