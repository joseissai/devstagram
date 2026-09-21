@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="  {{ route('perfil.store') }} " method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre
                    </label>
                    <input 
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Tu Nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value = "{{ auth()->user()->name }}"                        
                        >
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de usuario
                    </label>
                    <input 
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu Nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value = "{{ auth()->user()->username }}"                        
                        >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email de usuario
                    </label>
                    <input 
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Tu Email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value = "{{ auth()->user()->email }}"                        
                        >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_actual" class="mb-2 block uppercase text-gray-500 font-bold">Password actual
                    </label>
                    <input 
                        type="password"
                        id="password_actual"
                        name="password_actual"
                        placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password_actual') border-red-500 @enderror"
                        value = "{{old('password')}}"                        
                        >
                    @error('password_actual')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">{{$message}}</p>
                    @enderror                        
                </div>                

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password nueva
                    </label>
                    <input 
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        value = "{{old('password')}}"                        
                        >
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">{{$message}}</p>
                    @enderror                        
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmación de password nueva
                    </label>
                    <input 
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirmación de Password"
                        class="border p-3 w-full rounded-lg"
                        >
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil
                    </label>
                    <input                         
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg "                        
                        accept = ".jpg, .jpeg, .png"
                        />                    
                </div>

                <input 
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-7 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >

            </form>
        </div>
    </div>
@endsection