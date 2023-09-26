<section class="body_content">
<div class="container mt-5 todo">
        <div class="container d-flex justify-content-center flex-wrap">
                <div class="container card px-5 py-5 form1">
                    <div class="container-fluid m-0 p-0 mb-3 justify-content-center d-flex">
                        <img class="img-fluid img-login" src="./../imgs/logo-recicla+-business.svg"/>
                    </div>
                    <form action="/cadastro" method="post">
                        <div class="d-flex flex-wrap justify-content-evenly">
                            <div class="fr">
                                <div class="mb-3">
                                    <label for="numero_cartao" class="form-label">Número do cartão</label>
                                    <input type="text" class="form-control" id="numero_cartao" name="numero_cartao" style="width: 100%;">
                                </div>

                                <div class="mb-3">
                                    <label for="validade" class="form-label">Data de Vencimento</label>
                                    <input type="month" class="form-control" id="validade" name="validade" style="width: 100%;">
                                </div>

                                <div class="mb-3">
                                    <label for="nome_titular" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" style="width: 100%;">
                                </div>
                            </div>

                            <div class="fr">
                                <div class="mb-3">
                                    <label for="nome_titular" class="form-label">Nome do titular</label>
                                    <input type="text" class="form-control" id="nome_titular" name="nome_titular" style="width: 100%;">
                                </div>
                            
                                <div class="mb-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" style="width: 100%;">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="credito" id="credito" checked>
                                    <label class="form-check-label mt-1" for="credito">
                                        Crédito
                                    </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="debito" id="debito">
                                        <label class="form-check-label mt-1" for="debito">
                                            Débito
                                        </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary btn-cadastre " id="finaliza_cartão">Assinar</button></div>
                    </form>
                </div>
                <div class="card px-5 py-3 h-50 d-none justify-content-center align-content-center flex-wrap invalid-email" id="invalid-email">
                    <div class="container-progress">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="text-center">EMAIL NÃO CADASTRADO NO SISTEMA</p>
                </div>
                <div class="card px-5 py-3 h-50 d-none justify-content-center align-content-center flex-wrap invalid-email" id="invalid-password">
                    <div class="container-progress">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="text-center">SENHA INCORRETA</p>
                </div>
            
        </div>
    </div>
</section>   