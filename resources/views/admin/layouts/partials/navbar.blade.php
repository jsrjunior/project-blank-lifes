@php
    // Usuário logado via sessão (guard 'users')
    $user = user();
    // Token pessoal para chamadas API
    $token = $user ? $user->createToken('api-token')->plainTextToken : '';
@endphp

<input type="hidden" id="jwt_token_notification" value="{{ $token }}">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <!-- Aqui você pode inserir o título ou barra de pesquisa -->
        <li class="nav-item d-none d-sm-inline-block">
            <span class="navbar-text font-weight-light ml-3" id="topbar-title"></span>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notificações -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="user_notification_count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="user_notification_dropdown">
                <span class="dropdown-item dropdown-header">Notificações</span>
                <div class="dropdown-divider"></div>
                <div class="user-notification-loading">Carregando...</div>
            </div>
        </li>

        <!-- Menu do usuário -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mp" class="user-image img-circle elevation-2" alt="{{ $user->name }}">
                <span class="d-none d-md-inline">{{ strtok($user->name,' ') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User header -->
                <li class="user-header bg-primary">
                    <img src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mp" class="img-circle elevation-2" alt="{{ $user->name }}">
                    <p>
                        {{ $user->name }}
                        {{-- <small>{{ $user->roles->pluck('name')->join(', ') }}</small> --}}
                    </p>
                </li>
                <!-- Menu footer -->
                <li class="user-footer">
                    <a href="{{ route('web.admin.users.edit', ['id' => $user->id]) }}" class="btn btn-default btn-flat">Perfil</a>
                    <a href="{{ route('web.admin.logout') }}" class="btn btn-default btn-flat float-right">Sair</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    // Função para carregar notificações via API
    const token = document.getElementById('jwt_token_notification').value;

    function loadNotifications() {
        fetch('/api/notifications', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            const countEl = document.getElementById('user_notification_count');
            const dropdownEl = document.getElementById('user_notification_dropdown');

            countEl.textContent = data.length;

            dropdownEl.innerHTML = '<span class="dropdown-item dropdown-header">Notificações</span><div class="dropdown-divider"></div>';

            data.forEach(n => {
                const item = document.createElement('a');
                item.href = n.url || '#';
                item.className = 'dropdown-item';
                item.textContent = n.message;
                dropdownEl.appendChild(item);
                dropdownEl.appendChild(document.createElement('div')).className = 'dropdown-divider';
            });
        })
        .catch(err => {
            console.error('Erro ao carregar notificações:', err);
        });
    }

    // Carrega notificações ao abrir o dropdown
    document.querySelector('#user_notification_wrapper .nav-link')?.addEventListener('click', loadNotifications);
</script>

<style>
    /* Badge de notificação */
    .navbar-badge {
        font-size: 0.8rem;
    }

    /* Dropdown de notificações */
    #user_notification_dropdown {
        max-height: 400px;
        overflow-y: auto;
    }

    /* Responsividade mobile já tratada pelo AdminLTE */
</style>
