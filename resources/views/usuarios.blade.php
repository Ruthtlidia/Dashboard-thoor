@include('header')

<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Form elements </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
              </nav>
            </div>



            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Cadastro de Usuários</h4>
                    <form class="forms-sample" action="javascript:void(0)" method="post" id="frmCadUsuario">
                    @csrf
                      <div class="form-group row"  >
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nome</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Nome" @if(!empty(session('name')))value="{{session('name')}}" @endif required>
                          <input type="text" id="id" name="id" style="display: none;" @if(!empty(session('id')))value="{{session('id')}}" @endif >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" @if(!empty(session('email')))value="{{session('email')}}" @endif required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Senha</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Senha"  required>
                        </div>
                      </div>

                      <div class="form-group row"  >
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Digite novamente a senha</label>
                        <div class="col-sm-9" >
                          <input type="password" class="form-control" id="second_password" name="second_password" placeholder="Digite novamente a senha" required>
                        </div>
                      </div>
                      <div class="form-group row" style="margin-left: 0%;">
                        <label for="exampleSelectGender">Nível acesso</label>
                            <div class="col-sm-9" style="margin-left: 17%; ">
                                <select class="form-control" style="width: 15%; margin-left: 33px;" id="nivel_acesso" name="nivel_acesso" required>
                                @if(!empty(session('nivel_acesso') == 1))
                                    <option value="{{ session('nivel_acesso') }}">Administrador</option>
                                    <option value="2">Usuário</option>
                                @endif
                                @if(!empty(session('nivel_acesso') == 2))
                                    <option value="{{ session('nivel_acesso') }}">Usuário</option>
                                    <option value="1">Administrador</option>
                                @endif
                                @if(empty(session('nivel_acesso')))
                                    <option value="2">Usuário</option>
                                    <option value="1">Administrador</option>
                                @endif
                                </select>
                            </div>
                      </div>
                      @if(!empty(session('email')))
                        <button type="button" onclick="editarUsuario()" class="btn btn-primary mr-2">Salvar Edição</button>
                      @endif
                      @if(empty(session('email')))
                        <button type="button" onclick="cadastrarUsuario()" class="btn btn-primary mr-2">Salvar</button>
                      @endif


                    </form>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Usuários Cadastrados</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Nível Acesso</th>
                            <th>Data Cadastro</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($listaUsuarios))
                            @foreach($listaUsuarios as $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ ($user['nivel_acesso'] == 1 ? 'Administrador' : 'Usuário') }}</td>
                                <td>{{ date_format($user['created_at'], 'd/m/Y H:i:s' )}}</td>
                                <td><i class="mdi mdi-pencil"  onclick='alterarUser({{ $user["id"] }})' style='cursor: pointer;'></i></td>
                                <td><i class="mdi mdi-window-close" onclick='deletarUser({{ $user["id"] }})' style='cursor: pointer;'></i></td>
                            </tr>
                            @endforeach
                        @endif

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>










            </div>
          </div>
          <!-- content-wrapper ends -->





@include('footer')
