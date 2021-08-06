<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>
    </x-slot>

    <x-container id="app" class="py-6">
        <x-form-section class="mb-8">
            <x-slot name="title">
                Criar um novo cliente
            </x-slot>
            <x-slot name="description">
                Inserir os dados para criar um novo cliente
            </x-slot>

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">

                    <div v-if="createForm.errors.length > 0"
                        class="mb-4 bg-red-200 border border-red-800 text-red-600 px-4 py-3 rounded">
                        <strong class="font-bold">Opss!</strong>
                        <span>Algo deu errado!</span>

                        <ul>
                            <li v-for="error in createForm.errors ">
                                @{{ error }}
                            </li>
                        </ul>
                    </div>

                    <x-label class="text-black text-lg">Nome</x-label>

                    <x-input v-model="createForm.name" type="text" class="w-full mt-1"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label class="text-black text-lg">
                        Link de redirecionamento
                    </x-label>

                    <x-input v-model="createForm.redirect" type="text" class="w-full mt-1"/>
                </div>

            </div>


            <x-slot name="actions">
                <x-button v-on:click="store" v-bind:disabled="createForm.disabled">
                    Criar
                </x-button>

            </x-slot>


        </x-form-section>

        <x-form-section v-if="clients.length > 0">
            <x-slot name="title">
                Lista de Clientes
            </x-slot>
            <x-slot name="description">
                Aqui estçao todos os clientes cadastrados
            </x-slot>

            <div>
                <table class="text-black">
                    <thead class="border-b border-gray-900" >
                        <tr class="text-left">
                            <th class="py-2 w-full">Nome</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        <tr v-for="client in clients">
                            <td class="py-2">
                                @{{ client.name }}
                            </td>
                            <td class="flex divide-x divide-white py-2">
                                <a class="pr-2 hover:text-blue-600 font-semibold cursor-pointer">
                                    Editar
                                </a>
                                <a v-on:click="destroy(client)"
                                    class="pl-2 hover:text-red-600 font-semibold cursor-pointer">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>



        </x-form-section>
    </x-container>

    @push('js')

        <script>
            new Vue({
                el:"#app",
                data:{
                    clients: [],
                    createForm:{
                        disabled: false,
                        errors: [],
                        name: null,
                        redirect: null,
                    }
                },
                mounted() {
                    this.getClientes();
                },
                methods: {
                    getClientes(){
                        axios.get('/oauth/clients')
                            .then(response => {
                                this.clients = response.data
                            });
                    },
                    store() {

                        this.createForm.disabled = true;

                        axios.post('/oauth/clients', this.createForm)
                            .then(response => {
                                this.createForm.name = null;
                                this.createForm.redirect = null;
                                Swal.fire(
                                    'Criado com sucesso!',
                                    'Cliente foi cadastrado como sucesso.',
                                    'success'
                                );

                                this.getClientes();

                                this.createForm.disabled = false;

                        }).catch(error => {

                            this.createForm.errors = _.flatten(_.toArray(error.response.data.errors));
                            this.createForm.disabled = false;
                        });
                    },
                    destroy(client) {
                        Swal.fire({
                            title: 'Deseja excluir este registro?',
                            text: "Esta ação não será reversível",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, Excluir!'
                            }).then((result) => {
                            if (result.isConfirmed) {

                                axios.delete('/oauth/clients/' + client.id)
                                    .then(response => {
                                        this.getClientes();
                                    });

                                Swal.fire(
                                'Excluído!',
                                'O registro foi excluídi com sucesso',
                                'success'
                                )
                            }
                            })
                    }
                },
            });


        </script>

    @endpush
</x-app-layout>

