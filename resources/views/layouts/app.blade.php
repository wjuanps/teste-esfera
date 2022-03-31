<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                          <li class="nav-item">
                            <a class="nav-link" href="{{ Route('home') }}">{{ __('Home') }}</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ Route('user_admin.company.index') }}">{{ __('Companies') }}</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ Route('user_admin.employee.index') }}">{{ __('Employees') }}</a>
                          </li>
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }}
                              </a>

                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                                </form>
                              </div>
                          </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script type="text/javascript">
    feather.replace()

    window.onload = () => {
      let phones = document.getElementsByClassName('phone')
      Array.prototype.map.call(phones, phone => {
        if (!!phone.value) {
          phone.value = phoneFormatter(phone.value)
        }

        phone.addEventListener('blur', event => {
          event.target.value = phoneFormatter(event.target.value)
        })
      })

      let zipCodes = document.getElementsByClassName('zipcode')
      Array.prototype.map.call(zipCodes, zipCode => {
        if (!!zipCode.value) {
          zipCode.value = zipCodeFormmatter(zipCode.value)
        }

        zipCode.addEventListener('blur', async event => {
          let form = event.target.form
          let zipCode = event.target.value

          event.target.value = zipCodeFormmatter(zipCode)
          fillAddressFields(form, zipCode)
        })
      })

      let states = document.getElementsByClassName('state')
      Array.prototype.map.call(states, state => {
        if (!!state.value) {
          console.log(state);
          state.value = upperCase(state.value)
        }

        state.addEventListener('blur', event => {
          event.target.value = upperCase(event.target.value)
        })
      })

      let modalTriggers = document.getElementsByClassName('modal_trigger_button')
      Array.prototype.map.call(modalTriggers, modalTrigger => {
        modalTrigger.addEventListener('click', showModal)
      })
    }

    const phoneFormatter = (phone) => {
      phone = new String(phone).replace(/\D/g, "")

      let phoneRegex = /^([\d]{2})([\d]{4,5})([\d]{4})$/
      phone = phone.replace(phoneRegex, "($1) $2-$3")

      return phone
    }

    const zipCodeFormmatter = (zipCode) => {
      zipCode = new String(zipCode).replace(/\D/g, "")

      let zipCodeRegex = /^([\d]{5})([\d]{3})$/
      zipCode = zipCode.replace(zipCodeRegex, "$1-$2")

      return zipCode
    }

    const fillAddressFields = async (form, zipCode) => {
      let data = await searchZipCode(zipCode)

      if (!!data) {
        form.address_street.value   = data.logradouro
        form.address_district.value = data.bairro
        form.address_city.value     = data.localidade
        form.address_state.value    = data.uf
      }
    }

    const searchZipCode = async zipCode => {
      let zipcode = new String(zipCode).replace(/\D/g, "")

      const response = await fetch(`https://viacep.com.br/ws/${zipcode}/json/`)
      const data     = await response.json()

      return data
    }

    const showModal = event => {
      let modalId    = event.target.dataset.modalId
      let route      = event.target.dataset.route

      let form = document.querySelector(`#form_${modalId}`)
      form.action = route

      let modalEl = $(`#${modalId}`)
      modalEl.modal('show')
    }

    const upperCase = (value) => {
      return value.toUpperCase()
    }
  </script>
</body>
</html>
