<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Yajra\DataTables\DataTables;

class ClienteController extends Controller
{

    public function index() {
        return view('cliente');
    }

    public function datatable(Request $request) {
        if ($request->ajax()) {
            $data = Cliente::select('id', 'nome', 'cpf', 'data_nascimento', 'estado', 'cidade', 'sexo')->get();
            return DataTables::of($data)->toJson();
        }
    }

    public function getCidades($sigla)
    {
        $response = Http::get("http://educacao.dadosabertosbr.com/api/cidades/{$sigla}");
        return response()->json($response->json());
    }

    public function show($id) {
        // verificar se existe um cliente com esse id se não tiver retornar erro se tiver exibir o cliente
        $cliente = Cliente::find($id);
        if ($cliente) {
            return $cliente;
        } else {
            return response()->json(['message' => 'Cliente não encontrado!'], 400);
        }
    }

    public function store(Request $request) {
        // Verificar se existe já um cliente com o CPF informado
        // Remover caracteres não numéricos do CPF
        $cpf = preg_replace('/[^0-9]/', '', $request->input('cpf'));

        $cliente = Cliente::where('cpf', $cpf)->first();
        if ($cliente) {
            return response()->json(['message' => 'Cliente já cadastrado!'], 400);
        } else {
            // Usar o CPF limpo na criação do cliente
            $request->merge(['cpf' => $cpf]);
            $cliente = Cliente::create($request->all());
            return redirect()->route('clientes.index'); // Redirecionar para a view cliente.blade.php
        }
    }

    public function update(Request $request, $id) {
        // Verificar se existe um cliente com esse id
        $cliente = Cliente::find($id);
        if ($cliente) {
            // Remover caracteres não numéricos do CPF
            $cpf = preg_replace('/[^0-9]/', '', $request->input('cpf'));

            // Atualizar o cliente usando o CPF limpo
            $request->merge(['cpf' => $cpf]);
            $cliente->update($request->all());
            return $cliente;
        } else {
            return response()->json(['message' => 'Cliente não encontrado!'], 400);
        }
    }

    public function destroy($id) {
        // verificar se existe um cliente com esse id se não tiver retornar erro se tiver excluir o cliente
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return response()->json(['message' => 'Cliente excluído com sucesso!'], 200);
        } else {
            return response()->json(['message' => 'Cliente não encontrado!'], 400);
        }
    }

}
