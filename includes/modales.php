<!-- Modal Info Cards -->
<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="modalInfoBody"></div>
        </div>
    </div>
</div>

<!-- Modal Contacto Agente -->
<div class="modal fade" id="modalAgente" tabindex="-1" aria-labelledby="modalAgenteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="modalAgenteLabel">
                    Déjanos tus datos y te llamaremos lo antes posible
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3 fw-bold">¿Eres Cliente de Muvraline?</div>

                <div class="d-flex justify-content-center mb-3">
                    <button id="btnSi" type="button" class="btn btn-outline-warning me-2"
                        onclick="mostrarCliente('si')">Sí</button>
                    <button id="btnNo" type="button" class="btn btn-outline-warning"
                        onclick="mostrarCliente('no')">No</button>
                </div>

                <!-- Contenido para SI es cliente -->
                <div id="form-si" style="display:none;">
                    <div class="alert alert-warning py-2">
                        <strong>¿Por qué es tan importante tu DNI/NIE?</strong><br>
                        Así podremos ofrecerte el mejor precio.
                    </div>

                    <div class="mb-3">
                        <label class="form-label">DNI/NIE</label>
                        <input type="text" class="form-control" placeholder="12345678A / X1234567A">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono móvil</label>
                        <input type="tel" class="form-control">
                    </div>
                </div>

                <!-- Contenido para NO es cliente -->
                <div id="form-no" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Teléfono móvil</label>
                        <input type="tel" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Código postal</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" id="checkInfo">
                    <label class="form-check-label" for="checkInfo">
                        Quiero recibir información sobre productos y ofertas que me puedan beneficiar
                    </label>
                </div>

                <button class="btn btn-warning w-100">Te llamamos gratis</button>
            </div>
        </div>
    </div>
</div>