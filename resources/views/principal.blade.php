@include('header')


        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex align-items-center align-self-start">
                        <?php $faturamento_mensal = Session::get('faturamento_mensal'); ?>
                          <h3 class="mb-0">{{ $faturamento_mensal }}</h3>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Faturamento Mensal</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex align-items-center align-self-start">
                        <?php $receita_total_grafico = Session::get('total_receita_faturamento');
                              $receita_total_grafico = 'R$ ' . number_format($receita_total_grafico, 2, ',', '.')
                        ?>
                          <h3 class="mb-0">{{ $receita_total_grafico }}</h3>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Receita Total Gráfico</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex align-items-center align-self-start">
                        <?php $faturamento_anual = Session::get('faturamento_anual'); ?>
                          <h3 class="mb-0">{{ ltrim($faturamento_anual) }}</h3>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Faturamento Anual</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex align-items-center align-self-start">
                        <?php $carregamento_anual = Session::get('carregamento_mensal'); ?>
                          <h3 class="mb-0">{{ $carregamento_anual }}</h3>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Volume Carregado Mensal</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">


              <div class="col-lg-12 grid-margin ">
                <div class="card">
                  <div class="card-body" style="height:130%;">
                    <h4 class="card-title">Bar chart
                        <a  href="" data-toggle="modal" data-target="#modalFiltro">
                            <i class="mdi mdi-filter" style="margin-left: 99%;" title="Filtro" ></i>
                        </a>
                    </h4>
                    <canvas id="barChart" style="height: 120px; display: block; width: 451px;"></canvas>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="modalFiltro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content" style=" width: 1000px; height: 300px; margin-left: -45%;  margin-top: 45%;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Filtros</h5>
                      <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" >
                      <form enctype="multipart/form-data" action="javascript:void(0)" method="post" id="frmFiltrar">
                        @csrf
                        <div class="form-group hover"  id="blocoMotorista"  onblur="mostrarPlaca();" >
                            <label>Motorista</label>
                            <select class="js-example-basic-multiple" multiple="multiple" id="motorista[]" name="motorista[]" style="width:100%">
                                @foreach ($arrayMotoristas as $arrayMotorista)
                                    <option value="{{$arrayMotorista['motorista']}}">{{$arrayMotorista['motorista']}}</option>
                                 @endforeach
                            </select>
                          </div>

                          <?php $placasFiltro = Session::get('placas_filtro');?>
                          <div class="form-group" id="blocoPlaca">
                            <label>Placa</label>
                            <select class="js-example-basic-multiple" multiple="multiple" id="placa[]" name="placa[]" style="width:100%">
                                @foreach ($arrayPlacas as $arrayPlaca)
                                    @if(isset($placasFiltro))
                                        @foreach($placasFiltro as $placaFiltrada)

                                            @if($placaFiltrada == $arrayPlaca['placa'])
                                                <option selected value="{{$arrayPlaca['placa']}}">{{$arrayPlaca['placa']}}</option>
                                            @endif

                                            @if($placaFiltrada <> $arrayPlaca['placa'])
                                                <option value="{{$arrayPlaca['placa']}}">{{$arrayPlaca['placa']}}</option>
                                            @endif

                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                          </div>


                          <div class="form-group row">

                            <label for="example-date-input" class="col-2 col-form-label" >Data Inicial</label>
                            <div class="col-3" >
                                <input class="form-control" type="date" id="dataInicial" name="dataInicial" value="{{date('Y-m-d')}}" id="example-date-input">
                            </div>

                            <label for="example-date-input" class="col-2 col-form-label">Data Final (opicional)</label>
                            <div class="col-3" >
                                <input class="form-control" type="date" id="dataFinal" name="dataFinal" value="{{date('Y-m-d')}}" id="example-date-input">
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                <input type="checkbox" id="salvar_filtro" name="salvar_filtro" class="form-check-input"> Salvar filtro </label>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onclick="filtrar();">Aplicar filtros</button>
                          </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>
           @if(Session::get('motoristas') != NULL)
           <?php $motoristas = Session::get('motoristas'); ?>
            @endif

            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Faturamento Frota</h4>
                    <div class="table-responsive">
                      <table class="table">
                      <?php $faturamento_frota = Session::get('faturamento_frota');
                                  $faturamento_frota_motorista = Session::get('faturamento_frota_motorista');
                                $i = 0;
                            ?>
                        <thead>
                          <tr>
                            <th>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                </label>
                              </div>
                            </th>
                            <th> Motorista </th>
                            <th> Placa </th>
                            <th> Soma da receita </th>
                            @if(isset($faturamento_frota_motorista))
                                <th> Soma total da receita </th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>

                            <!-- Se vier filtro das placas -->
                            @if(isset($faturamento_frota))
                                @foreach ($faturamento_frota as $faturamento)
                                <?php $i++; ?>
                            <tr>
                                <td>
                                <div class="form-check form-check-muted m-0">
                                    @if($i == 1)
                                        <img src="assets/images/faces/ouro.png" alt="">
                                    @endif
                                    @if($i == 2)
                                        <img src="assets/images/faces/prata.png" alt="">
                                    @endif
                                    @if($i == 3)
                                        <img src="assets/images/faces/bronze.png" alt="">
                                    @endif
                                    @if($i != 1 && $i != 2 && $i != 3)
                                        <span>{{$i}}º</span>
                                    @endif

                                </div>
                                </td>
                                <td>
                                    <span class="pl-2">
                                        @foreach ($faturamento['motorista'] as $motorista)
                                            <p>
                                                {{ trim($motorista) }}
                                            </p>
                                        @endforeach
                                    </span>
                                </td>
                                <?php
                                    $resultado = '';
                                    $resultado = str_replace(' ', '', $faturamento['placa']);
                                    $resultado = substr_replace($resultado, '-', 3, 0);
                                ?>
                                    <td>
                                        {{ $resultado }}
                                    </td>

                                    <td>
                                        @foreach ($faturamento['faturamento'] as $faturamento)
                                            <p>
                                                R$: {{ trim($faturamento) }}
                                            </p>
                                        @endforeach
                                    </td>
                                <td>
                                </td>
                            </tr>
                            @endforeach
                          @endif

                          <!-- Se vier filtro dos motorista -->
                          @if(isset($faturamento_frota_motorista))
                                @foreach ($faturamento_frota_motorista as $faturamento_motorista)
                                <?php $i++; ?>
                            <tr>
                                <td>
                                <div class="form-check form-check-muted m-0">
                                    @if($i == 1)
                                        <img src="assets/images/faces/ouro.png" alt="">
                                    @endif
                                    @if($i == 2)
                                        <img src="assets/images/faces/prata.png" alt="">
                                    @endif
                                    @if($i == 3)
                                        <img src="assets/images/faces/bronze.png" alt="">
                                    @endif
                                    @if($i != 1 && $i != 2 && $i != 3)
                                        <span>{{$i}}º</span>
                                    @endif

                                </div>
                                </td>
                                <td>
                                    <span class="pl-2">
                                        <p>
                                            {{ trim($faturamento_motorista['motorista'][0]) }}
                                        </p>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        foreach($faturamento_motorista['placa'] as $placas){
                                            $resultado = str_replace(' ', '', $placas);
                                            $resultado = substr_replace($resultado, '-', 3, 0);?>

                                            {{ $resultado }} <br><br>

                                        <?php }
                                    ?>
                                </td>

                                    <td>
                                        @foreach ($faturamento_motorista['valor_placas'] as $valor_placa)
                                            <p>
                                                {{ trim($valor_placa) }}
                                            </p>
                                        @endforeach
                                    </td>

                                    <td>
                                        <p>
                                             {{ trim($faturamento_motorista['valor_total'][0]) }}
                                        </p>
                                    </td>
                                <td>
                                </td>
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

            <!-- Mês-->
            <div class="row ">
              <div class="col-4 grid-margin" >
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" >
                    DESEMPENHO THOOR 2019
                    </h4>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> </th>
                                <th></th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            </td>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td style="color: white;" > TOTAL</td>
                            <td style="color: white;"> R$:</td>
                            <td style="color: white;"> 1.859.042,69 </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Segunda -->
              <div class="col-4 grid-margin" >
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" >
                    DESEMPENHO THOOR  2020
                    </h4>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> </th>
                                <th></th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>FEVEREIRO</td>
                            <td>R$:</td>
                            <td>1.859.042,69</td>
                          </tr>
                          <tr>
                            </td>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td style="color: white;" > TOTAL</td>
                            <td style="color: white;"> R$:</td>
                            <td style="color: white;"> 1.859.042,69 </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fim Segunda -->
              <!-- terçeira -->
              <div class="col-4 grid-margin" >
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">
                    DECLÍNIO/CRESCIMENTO
                    </h4>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr style="color: red">
                            <td><span class="mdi mdi-arrow-bottom-left icon-item" ></span></td>
                            <td >R$: 1.859.042,69 </td>
                            <td >-6,52% </td>
                          </tr>
                          <tr style="color: green">
                            <td><span class="mdi mdi-arrow-top-right icon-item" ></span></td>
                            <td>R$: 1.859.042,69 </td>
                            <td >6,52% </td>
                          </tr>
                          <tr style="color: green">
                            <td><span class="mdi mdi-arrow-top-right icon-item" ></span></td>
                            <td >R$: 1.859.042,69 </td>
                            <td >6,52% </td>
                          </tr>
                          <tr style="color: red">
                            <td><span class="mdi mdi-arrow-bottom-left icon-item" ></span></td>
                            <td >R$: 1.859.042,69 </td>
                            <td >-6,52% </td>
                          </tr>
                          <tr>
                            <td style="color: white;" > TOTAL</td>
                            <td style="color: white;"> R$: 1.859.042,69 </td>
                            <td style="color: white;">9,90% </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fim terceira -->
               <!-- Porcentagem -->
               <!-- <div class="col-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" >
                    &emsp;&emsp;Percentual De Crescimento
                    </h4>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> </th>
                                <th></th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr style="color: red">
                            <td></td>
                            <td>-6,52%</td>
                            <td></td>
                          </tr>
                          <tr>
                            </td>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td> FEVEREIRO</td>
                            <td> R$:</td>
                            <td> 1.859.042,69 </td>
                          </tr>
                          <tr>
                            <td style="color: white;" > TOTAL</td>
                            <td style="color: white;"> R$:</td>
                            <td style="color: white;"> 1.859.042,69 </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- Fim Porcentagem -->
            </div>

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
@include('footer')
