<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index() {
        // exibir todos os clientes
        return Cliente::all();
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
        // verificar se existe ja um cliente com o cpf informado se não existir criar um novo cliente
        $cliente = Cliente::where('cpf', $request->cpf)->first();
        if ($cliente) {
            return response()->json(['message' => 'Cliente já cadastrado!'], 400);
        } else {
            return Cliente::create($request->all());
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
