<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;



class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $resp = Nota::orderBy('id', 'DESC')->get();
        $arrayTree = array();
        foreach($resp as $x)
        {
        $arrayTree[$x->id] = $x->id_father ;
        }
        $a  = $this->parseTree($arrayTree);
        return $a;
    }

    public function indextwo(Request $request)
    {
        //
        return Nota::orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nota = new Nota();
        $nota->name = $request->name;
        $nota->text = $request->text;
        $nota->id_father = $request->id_father;
        $nota->save();

        return $nota;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function parseTree($tree, $root = null)
    {
            $return = array();
        foreach($tree as $child => $parent) {
        if($parent == $root) {
            unset($tree[$child]);
            $return[] = array(
                'name' => $child,
                'children' => $this->parseTree($tree, $child)
            );
        }
    }
    return empty($return) ? null : $return;  
    }
}
