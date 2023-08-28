@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex">
        <img src="{{ asset('ijh8logo.png') }}" alt="ijh8logo" class="img-fluid mb-4" style="max-width: 200px;">
    </div>
        {{-- Formulário de Cadastro de Cliente --}}
        <div class="mb-4">
        <h2 class="cadastrocliente mb-3">Cadastro Cliente</h2>
        <form action="{{ route('clientes.store.api') }}" method="POST" class="border p-3 rounded shadow-sm bg-white">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required maxlength="14">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Sexo</label>
                    <div class="d-flex">
                        <div class="form-check form-check-inline me-2">
                            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="masculino" required>
                            <label class="form-check-label" for="masculino">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="feminino" value="feminino" required>
                            <label class="form-check-label" for="feminino">
                                Feminino
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="">Selecione um estado</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>
            </div>
                <div class="row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Salvar</button>
                        <button type="reset" class="btn btn-secondary">Limpar</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <h2 class="cadastrocliente mb-3">Consulta Cliente</h2>
        <div class="table-responsive border p-3 rounded shadow-sm bg-white overflow-hidden">
            <table id="cliente-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome <input type="text" class="form-control form-control-sm" id="searchNome"></th>
                        <th>CPF <input type="text" class="form-control form-control-sm" id="searchCpf"></th>
                        <th>Data de Nascimento <input type="text" class="form-control form-control-sm" id="searchDataNascimento"></th>
                        <th>Estado <input type="text" class="form-control form-control-sm" id="searchEstado"></th>
                        <th>Cidade <input type="text" class="form-control form-control-sm" id="searchCidade"></th>
                        <th>Sexo <input type="text" class="form-control form-control-sm" id="searchSexo"></th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- Modal de Edição -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            @csrf
                            <input type="hidden" id="editClientId">
                            <div class="mb-3">
                                <label for="editCpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="editCpf" name="cpf" required maxlength="11">
                            </div>
                            <div class="mb-3">
                                <label for="editNome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="editNome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDataNascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="editDataNascimento" name="data_nascimento" required>
                            </div>
                            <div class="mb-3">
                                <label for="editSexo" class="form-label">Sexo</label>
                                <select class="form-select" id="editSexo" name="sexo" required>
                                    <option value="">Selecione um sexo</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editEstado" class="form-label">Estado</label>
                                <select class="form-select" id="editEstado" name="estado" required>
                                    <option value="">Selecione um estado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editCidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="editCidade" name="cidade" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="saveEditBtn">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal de confirmação de exclusão --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Deseja realmente excluir este cliente?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
    $(document).ready(function() {

        console.log('Made by iJH8');
        console.log('github = https://github.com/jhmartins1');

        $('#cpf').inputmask("999.999.999-99");
        $('#cpf').on('change', function() {
            const cpfValue = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
            $(this).val(cpfValue);
        });

        const selectEstado = $('#estado');
        const editSelectEstado = $('#editEstado');
        const selectCidade = $('#cidade');

        // Função para popular os estados
        function popularEstados() {
            fetch('https://brasilapi.com.br/api/ibge/uf/v1')
                .then(response => response.json())
                .then(data => {
                    data.forEach(estado => {
                        const option = $('<option>', {
                            value: estado.sigla,
                            text: estado.sigla
                        });
                        selectEstado.append(option);
                        editSelectEstado.append(option.clone());
                    });
                });
        }

        popularEstados();

        // não exibir erro do datatable
        const dataTable = $('#cliente-table').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": "{{ route('cliente.datatable') }}",
            "columns": [
                {data: 'nome'},
                {data: 'cpf'},
                {data: 'data_nascimento'},
                {data: 'estado'},
                {data: 'cidade'},
                {data: 'sexo'},
            ],
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": [0,1,2,3,4,5,6],
                    "orderable": false,
                },
                // botao editar e excluir
                {
                    "targets": 6,
                    "data": "id",
                    "render": function(data, type, row) {
                        // botao de editar e excluir
                        return `
                            <button class="btn btn-sm btn-primary editar" data-cliente-id="${data}">Editar</button>
                            <button class="btn btn-sm btn-danger excluir" data-cliente-id="${data}">Excluir</button>
                        `;
                    }
                },
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';

            // Adicionar filtros de busca individuais
            $('#searchNome, #searchCpf, #searchDataNascimento, #searchEstado, #searchCidade, #searchSexo').on('keyup', function() {
                dataTable.column($(this).parent().index() + ':visible').search(this.value).draw();
            });

            $('#cliente-table tbody').on('click', '.editar', function () {
                // receber o id do botão clicado
                const clienteId = $(this).data('cliente-id');
                const table = $('#cliente-table').DataTable();
                const data = table.row($(this).parents('tr')).data();

                $('#editClientId').val(clienteId);
                $('#editCpf').val(data.cpf);
                $('#editNome').val(data.nome);
                $('#editDataNascimento').val(data.data_nascimento);
                $('#editEstado').val(data.estado);
                $('#editCidade').val(data.cidade);
                $('#editSexo').val(data.sexo);

                $('#editModal').modal('show');
            });

            $('#saveEditBtn').on('click', function() {
                const editClientId = $('#editClientId').val();
                const editCpf = $('#editCpf').val();
                const editNome = $('#editNome').val();
                const editDataNascimento = $('#editDataNascimento').val();
                const editSexo = $('#editSexo').val();
                const editEstado = $('#editEstado').val();
                const editCidade = $('#editCidade').val();

                const requestData = {
                    cpf: editCpf,
                    nome: editNome,
                    data_nascimento: editDataNascimento,
                    sexo: editSexo,
                    estado: editEstado,
                    cidade: editCidade,
                };

                const csrfToken = $('#editForm').find('input[name="_token"]').val();

                // Enviar requisição PUT para atualizar os dados do cliente
                $.ajax({
                    url: `/api/cliente/${editClientId}`,
                    type: 'PUT',
                    data: requestData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Atualizar o datatable
                        dataTable.ajax.reload();

                        // Fechar o modal de edição
                        $('#editModal').modal('hide');
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

        $('#cliente-table tbody').on('click', '.excluir', function () {
    // Armazenar o ID do cliente
    const clienteId = $(this).data('cliente-id');

    // Abrir o modal de confirmação
    $('#deleteModal').modal('show');

    // Quando o botão de confirmação de exclusão do modal for clicado
    $('#confirmDeleteBtn').on('click', function() {
        const csrfToken = $('#editForm').find('input[name="_token"]').val();

        // Enviar requisição DELETE para excluir o cliente
        $.ajax({
            url: `/api/cliente/${clienteId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Atualizar o datatable
                dataTable.ajax.reload();

                // Fechar o modal de confirmação
                $('#deleteModal').modal('hide');
            },
            error: function(error) {
                console.error(error);
            }
        });

        // Remover o evento de clique para evitar duplicação
        $('#confirmDeleteBtn').off('click');
    });
    });
});
    </script>
@endsection
