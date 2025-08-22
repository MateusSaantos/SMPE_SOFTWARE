<?php

namespace App\Http\Controllers;

use App\Models\Ncm;
use Illuminate\Http\Request;

class NcmController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [10,25,50,100])) $perPage = 10;

        $ncms = Ncm::query()
            ->when($q !== '', function ($query) use ($q) {
                $digits = preg_replace('/\D+/', '', $q);
                $query->where(function($qq) use ($q, $digits) {
                    $qq->where('descricao', 'like', "%{$q}%");
                    if ($digits !== '') {
                        $qq->orWhere('codigo', 'like', "%{$digits}%");
                    }
                });
            })
            ->orderBy('codigo')
            ->paginate($perPage);

        return view('ncms.index', [
            'ncms' => $ncms,
            'q'    => $q,
        ]);
    }

    public function create()
    {
        return view('ncms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo'    => 'required|digits:8|unique:ncms,codigo',
            'descricao' => 'required|string|max:255',
        ]);

        // setCodigoAttribute já normaliza
        Ncm::create($data);

        return redirect()->route('ncms.index')->with('success', 'NCM criado com sucesso.');
    }

    public function show(Ncm $ncm)
    {
        return view('ncms.show', compact('ncm'));
    }

    public function edit(Ncm $ncm)
    {
        return view('ncms.edit', compact('ncm'));
    }

    public function update(Request $request, Ncm $ncm)
    {
        $data = $request->validate([
            'codigo'    => 'required|digits:8|unique:ncms,codigo,' . $ncm->id,
            'descricao' => 'required|string|max:255',
        ]);

        $ncm->update($data);

        return redirect()->route('ncms.index')->with('success', 'NCM atualizado com sucesso.');
    }

    public function destroy(Ncm $ncm)
    {
        $ncm->delete();
        return redirect()->route('ncms.index')->with('success', 'NCM removido.');
    }
}
