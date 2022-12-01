<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Autor;

class AutorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $autors = Autor::all();

      return view('autor.list', ['autors' => $autors]);
    }

    function edit(Request $request, $id)
    { 
      $autor = Autor::find($id);
      if ($request->isMethod('post')) {    
        // recollim els camps del formulari en un objecte autor

        //$autor = new Autor;

        $request->validate([
          "nom" => 'required|min:2|max:20',
          "cognoms" => 'required',
        ],
        [
          "nom.required" => 'Has d\'introduir un nom',
          "nom.max" => 'El nom no pot ser superior als 20 caràcters',
          "nom.min" => 'El nom ha de ser superior als 2 caràcters',
          "cognoms.required" => 'Has d\'introduir els cognoms',
        ]);

        $autor->nom = $request->nom;
        $autor->cognoms = $request->cognoms;
        $autor->save();

        return redirect()->route('autor_list')->with('status', 'Autor '.$autor->titol.' modificat!');
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $autors = Autor::all();

      return view('autor.edit', ['autors' => $autors, 'autor' => $autor]);
    }

    function new(Request $request) 
    { 
      if ($request->isMethod('post')) {    
        // recollim els camps del formulari en un objecte autor

        $request->validate([
          "nom" => 'required|min:2|max:20',
          "cognoms" => 'required',
        ],
        [
          "nom.required" => 'Has d\'introduir un nom',
          "nom.max" => 'El nom no pot ser superior als 20 caràcters',
          "nom.min" => 'El nom ha de ser superior als 2 caràcters',
          "cognoms.required" => 'Has d\'introduir els cognoms',
        ]);

        $autor = new Autor;
        $autor->nom = $request->nom;
        $autor->cognoms = $request->cognoms;
        $autor->save();

        return redirect()->route('autor_list')->with('status', 'Nou autor '.$autor->titol.' creat!');
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $autors = Autor::all();

      return view('autor.new', ['autors' => $autors]);
    }

    function delete($id) 
    { 
      $autor = Autor::find($id);
      $autor->delete();

      return redirect()->route('autor_list')->with('status', 'Autor '.$autor->titol.' eliminat!');
    }
}