<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validação dos dados de entrada
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'user_id' => 'required|exists:users,id',  // Verifica se o usuário existe
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',  // Data de término deve ser depois da data de início,
                'type' => 'string'
            ]);
    
            // Criação do projeto
            $project = Project::create($validated);
    
            // Retornar o projeto recém-criado com status 201 (Created)
            return response()->json($project, 201);
        } catch (\Exception $e) {
            // Retornar mensagem de erro detalhada
            \Log::error('Erro ao criar o projeto: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao criar o projeto', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function userProjects($userId) {
        $projects = Project::where('user_id', $userId)->get();

        if($projects->isEmpty()) {
            return response()->json(['message' => 'Nenhum Projeto Encontrado']);
        }

        return response()->json($projects);
    }
 }
