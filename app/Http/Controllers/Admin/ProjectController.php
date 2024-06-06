<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ciao');
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        // dd($types);
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:5|max:150|unique:projects,name',
                'client_name' => 'required|min:5|max:20',
                'summary' => 'nullable|min:10',
                'cover_image' => 'nullable|image|max:512',
                'type_id' => 'nullable|exists:types,id'
            ]
        );

        $formData = $request->all();
        // dd($formData);
        // --------------------------------------------------------
        // solo se l'utente ha caricato la cover image
        // if(isset($formData['cover_image'])) {
        //oppure... 
        if ($request->hasFile('cover_image')) {
            // upload del file nella cartella pubblica(se non c'è la crea)
            $img_path = Storage::disk('public')->put('project_images', $formData['cover_image']);
            // salvare nella colonna cover_image del db il path all'immagine caricata
            // dd($img_path);
            $formData['cover_image'] = $img_path;
        }
        // ----------------------------------------------------------
        // dd($formData);
        $newProject = new Project();
        $newProject->fill($formData);
        // o si mette dopo che popolo $newProject senno la variabile è vuota oopure metto formData['name] al posto di $newProject->name
        $newProject->slug = Str::slug($newProject->name, '-');
        $newProject->save();

        session()->flash('project_create', true);

        return redirect()->route('admin.project.show', ['project' => $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::findOfFail($id); al  posto suo utiliziamo delle Dependency Injection Un design pattern che permette di iniettare le dipendenze necessarie in un componente, piuttosto che farle creare o trovare autonomamente.
        $data = [
            'project' => $project
        ];
        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $request->validate(
            [
                'name' => [
                    'required',
                    'min:5',
                    'max:150',
                    // 'unique:posts,title'
                    // si può mettere anche senza id
                    Rule::unique('projects')->ignore($project->id)
                ],
                'client_name' => 'required|min:5|max:20',
                'summary' => 'nullable|min:10',
                'cover_image' => 'nullable|image|max:512',
                'type_id' => 'nullable|exists:types,id'
            ]
        );


        $formData = $request->all();


        // se l'utente ha caricato una nuova immagine
        if ($request->hasFile('cover_image')) {
            // se avevo già un'immagine caricata la cancello
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            // upload del file nella cartella pubblica
            $img_path = Storage::disk('public')->put('project_images', $formData['cover_image']);
            // salvare nella colonna cover_image del db il path all'immagine caricata
            $formData['cover_image'] = $img_path;
        }


        $project->slug = Str::slug($formData['name'], '-');
        $project->update($formData);

        session()->flash('project_edit', true);


        return redirect()->route('admin.project.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        // dd('eliminato');
        // memorizzare temporaneamente un dato nella sessione dell'utente. Questo dato sarà disponibile solo per la prossima richiesta HTTP e poi sarà automaticamente rimosso.
        session()->flash('project_deleted', true);
        return redirect()->route('admin.project.index');
    }

    // public function destroyIds(Request $request)
    // {
    //     $ids = $request->get('ids');
    //     foreach($ids as $id){
    //         Project::find($id);
    //     }
    //     $project->delete();
    //     // dd('eliminato');
    //     // memorizzare temporaneamente un dato nella sessione dell'utente. Questo dato sarà disponibile solo per la prossima richiesta HTTP e poi sarà automaticamente rimosso.
    //     session()->flash('project_deleted', true);
    //     return redirect()->route('admin.project.index');
    // }
}
