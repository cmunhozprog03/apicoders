<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>
    </x-slot>

    <x-container class="py-6">
        <x-form-section>
            <x-slot name="title">
                Criar um novo cliente
            </x-slot>
            <x-slot name="description">
                Inserir os dados para criar um novo cliente
            </x-slot>
            <x-slot name="actions">
                Criar
            </x-slot>

            
        </x-form-section>
    </x-container>
</x-app-layout>

