@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <h1 class="text-xl font-bold mb-4">Registro de usuario</h1>

    <div id="error" class="hidden mb-4 p-3 rounded bg-red-100 text-red-700 text-sm"></div>
    <div id="respuesta" class="hidden mb-4 p-3 rounded bg-green-100 text-green-700 text-xs whitespace-pre-wrap"></div>

    <form id="register-form" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Nombre</label>
            <input type="text" id="name" class="mt-1 w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Correo</label>
            <input type="email" id="email" class="mt-1 w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Clave</label>
            <input type="password" id="password" class="mt-1 w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Confirmar clave</label>
            <input type="password" id="password_confirmation" class="mt-1 w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
            Registrar
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-600">
        La respuesta del controlador (mensaje y datos del usuario) se muestra debajo del formulario.
    </p>
@endsection

@section('scripts')
<script>
    const registerForm = document.getElementById('register-form');
    const errorDiv = document.getElementById('error');
    const respuestaDiv = document.getElementById('respuesta');

    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        errorDiv.classList.add('hidden');
        respuestaDiv.classList.add('hidden');
        errorDiv.textContent = '';
        respuestaDiv.textContent = '';

        const payload = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
        };

        try {
            const res = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json();

            if (!res.ok) {
                // Mostrar errores de validación (simple)
                if (data.errors) {
                    errorDiv.textContent = Object.values(data.errors).flat().join(' | ');
                } else {
                    errorDiv.textContent = data.message || 'Error al registrar usuario';
                }
                errorDiv.classList.remove('hidden');
                return;
            }

            // Mostrar respuesta del controlador (mensaje + usuario creado)
            respuestaDiv.textContent = JSON.stringify(data, null, 2);
            respuestaDiv.classList.remove('hidden');

        } catch (err) {
            console.error(err);
            errorDiv.textContent = 'Error de comunicación con el servidor';
            errorDiv.classList.remove('hidden');
        }
    });
</script>
@endsection
