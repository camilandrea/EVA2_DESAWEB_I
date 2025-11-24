@extends('layouts.app')

@section('title', 'Inicio de sesión')

@section('content')
    <h1 class="text-xl font-bold mb-4">Inicio de sesión</h1>

    <div id="error" class="hidden mb-4 p-3 rounded bg-red-100 text-red-700 text-sm"></div>
    <div id="respuesta" class="hidden mb-4 p-3 rounded bg-green-100 text-green-700 text-xs whitespace-pre-wrap"></div>

    <form id="login-form" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Correo</label>
            <input type="email" id="email" class="mt-1 w-full border rounded px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Clave</label>
            <input type="password" id="password" class="mt-1 w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
            Ingresar
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-600">
        La respuesta del controlador (token JWT) se muestra debajo del formulario.
    </p>
@endsection

@section('scripts')
<script>
    const loginForm = document.getElementById('login-form');
    const errorDiv = document.getElementById('error');
    const respuestaDiv = document.getElementById('respuesta');

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        errorDiv.classList.add('hidden');
        respuestaDiv.classList.add('hidden');
        errorDiv.textContent = '';
        respuestaDiv.textContent = '';

        const payload = {
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
        };

        try {
            const res = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json();

            if (!res.ok) {
                errorDiv.textContent = data.error || 'Error al iniciar sesión';
                errorDiv.classList.remove('hidden');
                return;
            }

            // Mostrar respuesta del controlador (token)
            respuestaDiv.textContent = JSON.stringify(data, null, 2);
            respuestaDiv.classList.remove('hidden');

            // Guardar token por si lo quieres usar luego
            if (data.token) {
                localStorage.setItem('token', data.token);
            }

        } catch (err) {
            console.error(err);
            errorDiv.textContent = 'Error de comunicación con el servidor';
            errorDiv.classList.remove('hidden');
        }
    });
</script>
@endsection
