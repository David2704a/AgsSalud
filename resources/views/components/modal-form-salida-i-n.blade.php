<div class="modal fade" id="modalFormSalidaIn" tabindex="-1" data-bs-keyboard="true" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Añadir Elementos
                </h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff;"></button> --}}
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times" style="color: #fff"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tableContainerElements">
                        <table class="table table-responsive table-secondary  table-hover" id="tableElementsModal">
                            <thead>
                                <tr>
                                    <th scope="col">ID DISPOSITIVO</th>
                                    <th scope="col">CATEGORIA</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger tooltips" data-bs-dismiss="modal">
                    Cerrar
                    <span class="tooltiptext">Ingreso / Salida</span>
                </button>
            </div>
        </div>
    </div>
</div>
