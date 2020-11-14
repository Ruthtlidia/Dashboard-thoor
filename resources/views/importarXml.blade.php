@include('header');

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Importar XML <a class="nav-link btn btn-danger create-new-button" id="createbuttonDropdown" style='width: 100px;'  aria-expanded="false" href="/deletar">- Deletar</a></h4>
                    <form class="forms-sample" enctype="multipart/form-data" id="frmImportar" action="javascript:void(0)" >
                        @csrf
                      <div class="form-group">
                        <input type="file"  id="arquivo" name="arquivo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload XML">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Carregar</button>
                          </span>
                        </div>
                      </div>
                      <button type="button" onclick="importarArquivo();" class="btn btn-primary mr-2">Importar</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@include('footer');
