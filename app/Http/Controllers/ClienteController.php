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
    // verificar se existe já um cliente com o CPF informado, se não existir, criar um novo cliente
    $cliente = Cliente::where('cpf', $request->cpf)->first();
    if ($cliente) {
        return response()->json(['message' => 'Cliente já cadastrado!'], 400);
    } else {
        $cliente = Cliente::create($request->all());
        return redirect()->route('clientes.index'); // Redirecionar para a view cliente.blade.php
    }
}


    public function update(Request $request, $id) {
        // verificar se existe um cliente com esse id se não tiver retornar erro se tiver atualizar o cliente
        $cliente = Cliente::find($id);
        if ($cliente) {
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
