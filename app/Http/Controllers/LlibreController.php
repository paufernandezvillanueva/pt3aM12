<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Llibre;
use App\Models\Autor;

class LlibreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $llibres = Llibre::all();

      return view('llibre.list', ['llibres' => $llibres]);
    }

    function edit(Request $request, $id) 
    { 
      $llibre = Llibre::find($id);
      if ($request->isMethod('post')) {    
        // recollim els camps del formulari en un objecte llibre

        //$llibre = new Llibre;

        $request->validate([
          "titol" => 'required|min:2|max:20',
          "dataP" => 'required|date|before_or_equal:' . date("d-m-Y"),
          "vendes" => 'required',
        ],
        [
          "titol.required" => 'Has d\'introduir un títol',
          "titol.max" => 'El títol no pot ser superior als 20 caràcters',
          "titol.min" => 'El títol ha de ser superior als 2 caràcters',
          "dataP.required" => 'Has d\'introduir una dataP',
          "dataP.date" => 'dataP ha de ser en format \'date\'',
          "dataP.before_or_equal" => 'La data ha de ser inferior o igual a ' . date("d/m/Y"),
          "vendes.required" => 'Has d\'introduir un número de vendes',
        ]);

        $llibre->titol = $request->titol;
        $llibre->dataP = $request->dataP;
        $llibre->vendes = $request->vendes;
        $llibre->autor_id = $request->autor_id;
        $llibre->save();

        return redirect()->route('llibre_list')->with('status', 'Llibre '.$llibre->titol.' modificat!');
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $autors = Autor::all();

      return view('llibre.edit', ['autors' => $autors, 'llibre' => $llibre]);
    }

    function new(Request $request) 
    { 
      if ($request->isMethod('post')) {    
        // recollim els camps del formulari en un objecte llibre

        $request->validate([
          "titol" => 'required|min:2|max:20',
          "dataP" => 'required|date|before_or_equal:' . date("d-m-Y"),
          "vendes" => 'required',
        ],
        [
          "titol.required" => 'Has d\'introduir un títol',
          "titol.max" => 'El títol no pot ser superior als 20 caràcters',
          "titol.min" => 'El títol ha de ser superior als 2 caràcters',
          "dataP.required" => 'Has d\'introduir una dataP',
          "dataP.date" => 'dataP ha de ser en format \'date\'',
          "dataP.before_or_equal" => 'La data ha de ser inferior o igual a ' . date("d/m/Y"),
          "vendes.required" => 'Has d\'introduir un número de vendes',
        ]);

        $llibre = new Llibre;
        $llibre->titol = $request->titol;
        $llibre->dataP = $request->dataP;
        $llibre->vendes = $request->vendes;
        $llibre->autor_id = $request->autor_id;
        $llibre->save();

        // Crear Cookie
        // return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->cookie('autor', $llibre->autor_id, 60);

        if ($llibre->autor_id == null) {
          return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->withoutCookie('autor');
        } else {
          return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->cookie('autor', $llibre->autor_id, 60);
        }
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $autors = Autor::all();
      $autorId = $request->cookie('autor');

      // Llegir Cookie
      return view('llibre.new', [
        'autors' => $autors,
        'autorId' => $autorId
      ]);
    }

    function delete($id) 
    { 
      $llibre = Llibre::find($id);
      $llibre->delete();

      return redirect()->route('llibre_list')->with('status', 'Llibre '.$llibre->titol.' eliminat!');
    }
}
