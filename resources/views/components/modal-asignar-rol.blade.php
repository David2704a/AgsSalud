{{-- <div id="modalAsignarRol" class="modal_roles">
    <div class="modal_content">
        <div class="modal_header">

            <div class="modal_title">
                <h3>ASIGNAR ROL</h2>
            </div>
        </div>
        <div class="modal_body">

        </div>
        <br>
    </div>
</div> --}}

<div class="modal fade" style="width: width: 100%;
    height: 100%;" id="modalAsignarRolBoots" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="justify-content: space-between;">
                <h5 class="modal-title" id="modalTitleId">
                    ASIGNAR ROL
                </h5>
                {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button> --}}
                <span data-bs-dismiss="modal" aria-label="Close" class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="roles">
                    @foreach ($roles as $rol)
                        <div class="card_rol">
                            <div class="icon_rol">
                                @include('components.svg-fondo-edit-p', [
                                    'gradientId' => 'gradient_new_a',
                                    'patternId' => 'pattern_new_b',
                                ])
                                <div class="img">
                                    @if ($rol->name === 'superAdmin')
                                        <img src="{{ asset('img/admin.png') }}" width="90px" alt="">
                                    @elseif ($rol->name === 'administrador')
                                        <img src="{{ asset('img/admin2.png') }}" width="90px" alt="">
                                    @elseif ($rol->name === 'tecnico')
                                        <img src="{{ asset('img/tecnico.png') }}" width="90px" alt="">
                                    @elseif ($rol->name === 'colaborador')
                                        <img src="{{ asset('img/colaborador.png') }}" width="90px" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="card_body">
                                <div class="body_title">
                                    <h6>
                                        {{ ucwords(preg_replace('/(?<!^)([A-Z])/', ' $1', $rol->name)) }}

                                    </h6>
                                </div>
                                <div class="card_button">
                                    <button class="action_has has_liked" id="asginarRolId_{{ $rol->id }}" aria-label="like" type="button"
                                        data-idrol="{{ $rol->id }}" data-namerol="{{$rol->name}}">
                                        <span data-icon=""><svg data-icon="aoeri" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                stroke-linejoin="round" stroke-linecap="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor" fill="none">
                                                <path
                                                    d="m8.05,11.99c0-.84.28-1.07,1.2-1.25,1.6-.31,2.35-.74,3.14-1.54,1.19-1.21,1.58-1.97,2.18-3.24.66-1.69,1.55-2.82,3.04-2.76.9.03,2.33.8,1.67,2.72-.31.9-1.98,3.61-2.23,4.23-.18.46.4.8.8.8h2.5c1.2,0,2.2,1,2.2,2.2l-1.1,5.6c-.3,1.5-1.02,2.23-2.2,2.2h-7.6c-2,0-3.6-1.6-3.6-3.6v-5.35Z"
                                                    data-d="thumb"></path>
                                                <path
                                                    d="m5.4,19.9c0,.6-.5,1.1-1.1,1.1h-1c-1,0-1.9-.9-1.9-1.9v-6.3c0-1,.9-1.9,1.9-1.9h.9c.7,0,1.2.6,1.2,1.2v7.7Z"
                                                    data-d="sleeves"></path>
                                            </svg></span> <span class="letters">Asignar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script>


<style>
    .action_has {
        --color: 0 0% 60%;
        --color-has: 211deg 100% 48%;
        --sz: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        height: calc(var(--sz) * 2.5);
        width: calc(var(--sz) * 8);
        padding: 0.4rem 0.5rem;
        border-radius: 0.375rem;
        border: 2px solid hsl(var(--color));
        justify-content: space-between
    }

    .action_has .letters {
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .has_liked svg,
    .has_saved svg {
        overflow: visible;
        height: calc(var(--sz) * 1.75);
        width: calc(var(--sz) * 1.75);
        --ease: cubic-bezier(0.5, 0, 0.25, 1);
        --zoom-from: 1.75;
        --zoom-via: 0.75;
        --zoom-to: 1;
        --duration: 1s;
    }

    .has_liked:hover {
        transition: border-color var(--duration) var(--ease);
        border: 2px solid hsl(var(--color-has));
        color: hsl(var(--color-has))
    }

    .has_liked:hover svg,
    .has_saved:hover svg {
        fill: hsl(var(--color-has) / 0.5);
        color: hsl(var(--color-has));
    }

    .has_liked:hover [data-d="thumb"] {
        animation: has-liked-thumb var(--duration) var(--ease) forwards;
    }

    .has_liked:hover [data-d="sleeves"] {
        animation: has-liked-sleeves var(--duration) var(--ease) forwards;
    }

    @keyframes has-liked-thumb {
        33.333% {
            transform: rotate(-20deg) translate(1px, 2px) scale(var(--zoom-from));
        }

        66.666% {
            transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
            d: path("m8.05,11.99c0-.84.28-1.07,1.2-1.25,1.6-.31,2.3-.64,2.9-1.09,0,0,1.64-1.31,2.21-3.11,1.12-3.59,2.11-4.85,3.72-4.85,2.27,0,2.96,2.22,2.55,3.54-.6,1.97-3.81,4.09-3.94,4.99-.07.49.76.72,1.16.72h2.5c1.2,0,2.2,1,2.2,2.2l-1.1,5.6c-.3,1.5-1.02,2.23-2.2,2.2h-7.6c-2,0-3.6-1.6-3.6-3.6v-5.35Z"
                );
        }

        99.999% {
            transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
        }
    }

    @keyframes has-liked-sleeves {
        33.333% {
            transform: rotate(10deg) translate(6px, -2px) scale(var(--zoom-from));
        }

        66.666% {
            transform: rotate(-10deg) translate(-6px, 0px) scale(var(--zoom-via));
        }

        99.999% {
            transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
        }
    }
</style>
