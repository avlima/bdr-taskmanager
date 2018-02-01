<?php

namespace App\Http\Controllers;

use App\TaskModel;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskModel::orderBy('order')->get();

        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'       => 'required|string|min:2|max:100',
                'description' => 'required|string|min:5',
            ],
            [
                'min'      => ':attribute deve ter no mínimo :min caracteres.',
                'max'      => ':attribute não deve ter mais que :max caracteres.',
                'required' => 'O campo :attribute é obrigatório.',
                'string'   => ':attribute deve ser uma string',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $task = TaskModel::create([
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => (DB::table('todo')
                                ->orderBy('order', 'desc')
                                ->first()->order + 1)
        ]);

        return response()->json($task, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'       => 'required|string|min:2|max:100',
                'description' => 'required|string|min:5',
                'order'       => 'required'
            ],
            [
                'min'      => ':attribute deve ter no mínimo :min caracteres.',
                'max'      => ':attribute não deve ter mais que :max caracteres.',
                'required' => 'O campo :attribute é obrigatório.',
                'string'   => ':attribute deve ser uma string',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        if (TaskModel::find($id)) {
            if (TaskModel::where('id', $id)->update($request->all())) {
                return response()->json(TaskModel::find($id), 200);
            }

            return response()->json([
                'error' => 'O registro não sofreu alterações.'
            ], 400);
        }

        return response()->json([
            'error' => 'O registro não encontrado.'
        ], 400);
    }

    /**
     * Update Order the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        foreach ($request->all() as $item) {
            if ($task = TaskModel::find($item['id'])) {
                $task->order = $item['order'];
                $task->save();
            }
        }

        return response()->json([
            'message' => 'O registros ordenas com sucesso.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($task = TaskModel::find($id)) {
            $task->delete();

            return response()->json($task, 200);
        }

        return response()->json([
            'error' => 'O registro não foi excluído.'
        ], 400);
    }
}
