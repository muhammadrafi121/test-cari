<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('province')) {
            $articles = [
                "data" => DB::table('articles')->where('province', $request->input('province'))->get()
            ];
            return response()->json($articles);
        } else if ($request->filled('city')) {
            $articles = [
                "data" => DB::table('articles')->where('city', $request->input('city'))->get()
            ];
            return response()->json($articles);
        }
        
        $articles = [
            "data" => Article::all()
        ];
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [
            'title' => $request->input('title'),
            'authors' => $request->input('authors'),
            'abstract' => $request->input('abstract'),
            'keyword' => $request->input('keyword'),
            'date' => $request->input('date'),
            'journal' => $request->input('journal'),
            'doi' => $request->input('doi'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
        ];

        DB::table('articles')->insert($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Article::find($id);
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
        $input = [
            'title' => $request->input('title'),
            'authors' => $request->input('authors'),
            'abstract' => $request->input('abstract'),
            'keyword' => $request->input('keyword'),
            'date' => $request->input('date'),
            'journal' => $request->input('journal'),
            'doi' => $request->input('doi'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
        ];

        DB::table('articles')
            ->where('id', $id)
            ->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('articles')
            ->where('id', $id)
            ->delete();
    }
}
