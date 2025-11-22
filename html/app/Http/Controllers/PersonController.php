<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $people = Person::withCount('contacts')->get();
        return view('people.index', compact('people'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(StorePersonRequest $request)
    {
        try {
            $avatar = $this->generateAvatar();

            $person = Person::create([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $avatar,
            ]);

            return redirect()->route('people.show', $person->id)
                ->with('success', 'Pessoa criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar pessoa: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Person $person)
    {
        $person->load('contacts');
        return view('people.show', compact('person'));
    }

    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    public function update(UpdatePersonRequest $request, Person $person)
    {
        try {
            $person->update($request->validated());
            return redirect()->route('people.show', $person->id)
                ->with('success', 'Pessoa atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar pessoa: ' . $e->getMessage());
        }
    }

    public function destroy(Person $person)
    {
        try {
            $person->delete();
            return redirect()->route('people.index')
                ->with('success', 'Pessoa eliminada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao eliminar pessoa: ' . $e->getMessage());
        }
    }

    private function generateAvatar()
    {
        try {
            $response = Http::timeout(5)->get('https://app.pixelencounter.com/api/basic/monsters/random');

            if ($response->successful()) {
                $content = $response->body();
                if (strpos($content, '<svg') !== false) {
                    return $content;
                }
            }
        } catch (\Exception $e) {
            Log::warning('Avatar API failed: ' . $e->getMessage());
        }

        return null;
    }
}
